<?php

namespace App\Http\Controllers\Agent;
use App\Models\CardReport;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;
use League\Csv\Reader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Card;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Auth;
class CardController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        if ($request->ajax() && !$request->has('is_view')) {
            $row = Card::where('category', new ObjectId($id))->get();

            return DataTables::of($row)
                ->addIndexColumn()
                ->editColumn('isUsed', function ($row) {
                    $column = "";
                    if ($row->isUsed == true) {
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>مباع</span>";
                    } else {

                        $column = "<span class='badge badge-light-danger'style='font-size: 14px'>غير مباع</span>";
                    }
                    return $column;
                })
                ->rawColumns(['isUsed'])
                ->make(true);
        }

        return view('dashboard.cards.index')->with('id', $id);
    }

    public function create(Request $request)
    {
        $id = $request->query('id');
        $network_id = $request->query('network');
        return view('dashboard.cards.create', compact('id', 'network_id'));
    }

/*    public function store(Request $request)
    {
        try {

            $csvFile = $request->file('csv');

            $isFirstRow = true;

            if (!$csvFile) {
                return response()->json(['success' => false, 'message' => 'Please select a CSV file.'], 422);
            }

            $rows = array_map(function ($row) {
                return str_getcsv($row, ';'); // Use ';' as the separator and '"' as the enclosure character
            }, file($csvFile));
            $rowCount = count($rows) - 1;

            foreach ($rows as $row) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue; // Skip the first row
                }

                // Remove any double quotes and single quotes and trim spaces from values
                $code = isset($row[0]) ? preg_replace('/[\'"]/', '', trim($row[0])) : null;
                $password = isset($row[1]) ? preg_replace('/[\'"]/', '', trim($row[1])) : null;

                $validator = Validator::make([
                    'code' => $code,
                    'password' => $password,
                ], [
                    'code' => 'required|string',
                    'password' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
                }
                $randomNumber = (int) substr(round(now()->timestamp / 100), -7);
                $data = [
                    'code' => $code,
                    'password' => $password,
                    'category' => new ObjectId($request->input('category')),
                    'network' => new ObjectId($request->input('network')),
                    'isUsed' => false,
                ];


                Card::create($data);
            }
            $Reportdata = [
                'invoice_number' => $randomNumber,
                'password' => $password,
                'category' => new ObjectId($request->input('category')),
                'network' => new ObjectId($request->input('network')),
                'quantity' => $rowCount,
                'user' => new ObjectId(Auth::id()),
            ];
            CardReport::create($Reportdata);

            $response = [
                'success' => true,
                'message' => 'تم إضافة البطاقات بنجاح!',
            ];

            // Return the JSON response
            return response()->json($response);
        } catch (\Exception $e) {
            // If any exception occurs, return an error response with an appropriate message
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }*/
    public function store(Request $request)
    {
       $cat =  $request->input('category');
        $existingCodes = Card::where('category',new ObjectId($cat))->pluck('code')->toArray();
        $csvFile = $request->file('csv');
        $extension = $csvFile->getClientOriginalExtension();
        // Dump and die to see the file extension

        if ($csvFile && $extension === 'csv') {
            $csv = Reader::createFromPath($csvFile->getPathname());
            $csv->setDelimiter(';'); // Set the delimiter used in your CSV

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $filteredDataForDb = [];
            $isFirstRow = true;

            foreach ($csv as $csvRow) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue;
                }
                if (count($csvRow) == 1) {
                    $cleanedValue = trim($csvRow[0], '"');
                    $csvRow = explode(';', $cleanedValue);
                }
                $cleanedRow = array_map(function ($value) {
                    return str_replace('"', '', $value);
                }, $csvRow);
                    $codeIndex = count($csvRow)-2;
                    $passIndex = count($csvRow)-1;

                $code = isset($cleanedRow[$codeIndex]) ? $cleanedRow[$codeIndex] : null;
                $password = isset($cleanedRow[$passIndex]) ? $cleanedRow[$passIndex] : null;
                if ($code !== null && $password !== null && !in_array($code, $existingCodes)) {
                    $filteredDataForDb[] = [
                        'code' => $code,
                        'password' => $password,
                        'category' => new ObjectId($request->input('category')),
                        'network' => new ObjectId($request->input('network')),
                        'isUsed' => false,
                    ];

                }
            }
            Card::insert($filteredDataForDb);

            $randomNumber = (int) substr(round(microtime(true) * 1000), -7);
            $rowCount = count($filteredDataForDb);

            $Reportdata = [
                'invoice_number' => $randomNumber,
                'password' => $filteredDataForDb[0]['password'], // Change this if needed
                'category' => new ObjectId($request->input('category')),
                'network' => new ObjectId($request->input('network')),
                'quantity' => $rowCount,
                'status' => 'unpaid',
                'user' => new ObjectId(Auth::id()),
            ];

            foreach ($filteredDataForDb as $index => $data) {
                $rowIndex = $index + 1;
                $sheet->setCellValue('A' . $rowIndex, $data['code']);
                $sheet->setCellValue('B' . $rowIndex, $data['password']);
                // Add other cell values as needed
            }
            CardReport::create($Reportdata);
            $now = now()->format('Ymd_His');
            $fileName = "files/network_{$request->input('network')}.category_{$request->input('category')}_{$now}.xlsx";
            $filteredExcelPath = public_path($fileName);

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filteredExcelPath);


            $response = [
                'success' => true,
                'message' => 'تم إضافة البطاقات بنجاح!',
                'data' => $filteredDataForDb, // Send the processed card data in the response
            ];

            return response()->json($response);
        }

        // Handle case where no CSV file was uploaded

        return response()->json($response);
    }

    public function show($id)
    {
    }
}

