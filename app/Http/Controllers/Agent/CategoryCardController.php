<?php

namespace App\Http\Controllers\Agent;
use App\Http\Requests\CategoryRequest;
use App\Models\Card;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Corrected the import here
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryCard;
use MongoDB\BSON\ObjectId;

class CategoryCardController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        if ($request->ajax()&& !$request->has('is_view')) {
            $row = CategoryCard::where('network', new ObjectId($id))->get();
            return DataTables::of($row)
                ->addColumn('image', function ($row) {
                    $imageUrl = asset($row->photo);
                    return '<img src="' . $imageUrl . '" alt="Static Image" width="50">';
                })
                ->editColumn('periodType', function ($row) {
                    $column = "";
                    if ($row->periodType == 'H') {
                        $column = "<span class='badge badge-light-primary' style='font-size: 14px'>$row->period ساعة</span>";
                    }
                    else if ($row->periodType == 'D') {
                        $column = "<span class='badge badge-light-warning' style='font-size: 14px'>$row->period يوم</span>";
                    }
                    else if($row->periodType == 'W')  {
                        $column = "<span class='badge badge-light-info' style='font-size: 14px'>$row->period اسبوع</span>";
                    }else if($row->periodType == 'M')  {
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>$row->period شهر</span>";
                    }
                    return $column;
                })
                ->addColumn('catCard', function ($row) use ($id) {
                    $totalCard = Card::where('network', new ObjectId($id))->where('category',new ObjectId($row->_id))->count();
                    return $totalCard;
                })

                ->addColumn('action', function ($row) use ($id) {
                    return view('dashboard.category-cards.components.action', ['id' => $row->_id,'network_id'=>$id])->render();
                })
                ->rawColumns(['image','action','periodType','catCard'])
                ->make(true);
        }

        return view('dashboard.category-cards.index',compact('id'));

    }

    public function create(Request $request)
    {
        $id = $request->id;
        return view('dashboard.category-cards.create',compact('id'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $data = [
                'cname' => $validatedData['cname'],
                'price' => $validatedData['price'],
                'period' => $validatedData['period'],
                'periodType' => $validatedData['periodType'],
                'network' => new ObjectId($validatedData['network']),
            ];



            // Prepare the data to be saved in the database


            // Handle the photo upload if provided
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileExtension = $file->getClientOriginalExtension();

                $categoryCard = new CategoryCard($data);

                $categoryCard->save();

                $categoryId = $categoryCard->_id;
                $fileName = 'category-' . $categoryId . '.' . $fileExtension;

                $directory = 'imgs/networks/network-' . $data['network'];

                $file->move(public_path($directory), $fileName);
                $categoryCard->update(['photo' => $directory . '/' . $fileName]);
            }

            // Save the data to the database

            $response = [
                'success' => true,
                'message' => 'تم إضافة الفئة بنجاح!',
                'data' => $data, // Optionally, you can send back the newly created category card data in the response
            ];

            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        try {
            $categoryCard = CategoryCard::findOrFail($id);


            return view('dashboard.category-cards.edit', compact('categoryCard'));
        } catch (\Exception $e) {
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $data = [
                'cname' => $validatedData['cname'],
                'price' => $validatedData['price'],
                'period' => $validatedData['period'],
                'periodType' => $validatedData['periodType'],
                'network' => new ObjectId($validatedData['network']),
            ];


            $categoryCard = CategoryCard::findOrFail($id);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileExtension = $file->getClientOriginalExtension();

                $newFileName = 'category-' . $id . '.' . $fileExtension;

                $directory = 'imgs/networks/network-' . $data['network'];

                $file->move(public_path($directory), $newFileName);

                $data['photo'] = $directory . '/' . $newFileName;

            }

            $categoryCard->update($data);
            $response = [
                'success' => true,
                'message' => 'تم تعديل الفئة بنجاح!',
                'data' => $data,
            ];

            return response()->json($response);

        } catch (ValidationException $e) {

        } catch (\Exception $e) {
        }
    }

    public function destroy($id)
    {
    }
}
