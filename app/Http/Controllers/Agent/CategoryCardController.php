<?php

namespace App\Http\Controllers\Agent;
use App\Http\Requests\CategoryRequest;
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
                    return '<img src="' . $imageUrl . '" alt="Static Image" width="200">';
                })
                ->editColumn('periodType', function ($row) {
                    $column = "";
                    if ($row->periodType == 'H') {
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>$row->period ساعة</span>";
                    }
                    else if ($row->periodType == 'D') {
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>$row->period يوم</span>";
                    }
                    else if($row->periodType == 'W')  {
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>$row->period اسبوع</span>";
                    }else if($row->periodType == 'M')  {
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>$row->period شهر</span>";
                    }
                    return $column;
                })


                ->addColumn('action', function ($row) use ($id) {
                    return view('dashboard.category-cards.components.action', ['id' => $row->_id,'network_id'=>$id])->render();
                })
                ->rawColumns(['image','action','periodType'])
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

                // Create a new instance of CategoryCard
                $categoryCard = new CategoryCard($data);

                // Save the category card to the database (this will insert a new document)
                $categoryCard->save();

                // Generate the category card ID and use it in the image file name
                $categoryId = $categoryCard->_id;
                $fileName = 'category-' . $categoryId . '.' . $fileExtension;

                // Define the directory where the file will be stored
                $directory = 'imgs/networks/network-' . $data['network'];

                // Save the image file to the specified directory
                $file->move(public_path($directory), $fileName);

                // Update the category card record with the image URL
                $categoryCard->update(['photo' => $directory . '/' . $fileName]);
            }

            // Save the data to the database

            $response = [
                'success' => true,
                'message' => 'تم إضافة الفئة بنجاح!',
                'data' => $data, // Optionally, you can send back the newly created category card data in the response
            ];

            // Return the JSON response
            return response()->json($response);
        } catch (ValidationException $e) {
            // If validation fails, return the validation errors as a JSON response
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            // If any other exception occurs, return an error response with an appropriate message
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        try {
            // Retrieve the CategoryCard record by its ID
            $categoryCard = CategoryCard::findOrFail($id);

            // You may want to retrieve additional data like networks if needed
            // For example: $networks = Network::all();

            // Return the view that contains the edit form along with the retrieved data
            return view('dashboard.category-cards.edit', compact('categoryCard'));
        } catch (\Exception $e) {
            // Handle the exception (e.g., show an error page or redirect with a message)
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            // Validate the incoming request data, similar to the 'store' function
            $validatedData = $request->validated();

            // Prepare the data to be saved in the database
            $data = [
                'cname' => $validatedData['cname'],
                'price' => $validatedData['price'],
                'period' => $validatedData['period'],
                'periodType' => $validatedData['periodType'],
                'network' => new ObjectId($validatedData['network']),
            ];

            // Prepare the data to be updated in the database


            // Find the CategoryCard record by its ID
            $categoryCard = CategoryCard::findOrFail($id);

            // Handle the photo update if provided
            if ($request->hasFile('photo')) {
                // Handle the new image upload similar to the 'store' function
                $file = $request->file('photo');
                $fileExtension = $file->getClientOriginalExtension();

                // Generate the new image file name with the category card ID
                $newFileName = 'category-' . $id . '.' . $fileExtension;

                // Define the directory where the file will be stored
                $directory = 'imgs/networks/network-' . $data['network'];

                // Save the new image file to the specified directory
                $file->move(public_path($directory), $newFileName);

                // Update the 'photo' field in the $data array with the new image URL
                $data['photo'] = $directory . '/' . $newFileName;

            }

            // Update the CategoryCard record with the new data
            $categoryCard->update($data);
            $response = [
                'success' => true,
                'message' => 'تم تعديل الفئة بنجاح!',
                'data' => $data, // Optionally, you can send back the newly created category card data in the response
            ];

            // Return the JSON response
            return response()->json($response);

            // Return a success response or redirect back with a success message
            // ...

        } catch (ValidationException $e) {
            // If validation fails, return the validation errors as a JSON response or redirect back with errors
            // ...

        } catch (\Exception $e) {
            // If any other exception occurs, return an error response with an appropriate message or redirect back with an error message
            // ...

        }
    }

    public function destroy($id)
    {
    }
}
