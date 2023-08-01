<?php

namespace App\Http\Controllers\Agent;
use App\Models\Report;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\BSON\ObjectId;
use App\Models\Card;
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
                ->rawColumns(['isUsed']) // Specify which columns should not be escaped
                ->make(true);
        }

        return view('dashboard.cards.index')->with('id', $id); // Pass $id to the view.
    }

    public function create(Request $request)
    {
        $id = $request->query('id');
        $network_id = $request->query('network');
        return view('dashboard.cards.create', compact('id', 'network_id'));
    }

    public function store(Request $request)
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
            Report::create($Reportdata);

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
    }

}
