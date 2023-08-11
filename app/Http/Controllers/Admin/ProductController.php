<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Network;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()&& !$request->has('is_view')) {
            $row = Product::all();
            return DataTables::of($row)->addColumn('imageCover', function ($row) {
                    $imageUrl = asset($row->imageCover);
                    return '<img src="' . $imageUrl . '" alt="Static Image" width="100" height="50">';
                }) ->editColumn('description', function ($row) {
                    $words = explode(' ', $row->description);
                    $shortenedDescription = implode(' ', array_slice($words, 0, 5));
                    return $shortenedDescription . '...';
                })
                ->editColumn('price', function ($row) {
                  $column =  '₪'.$row->price - ($row->price * $row->discount/100);
                    return $column ;
                })
                ->editColumn('title', function ($row) {
                    $words = explode(' ', $row->title);
                    $shortenedDescription = implode(' ', array_slice($words, 0, 5));
                    return $shortenedDescription . '...';
                })
                ->editColumn('availability', function ($row) {
                    if($row->availability == true){
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>متوفر</span>";
                    }elseif ($row->availability == false){
                        $column = "<span class='badge badge-light-danger' style='font-size: 14px'>غير متوفر</span>";
                    }
                    return $column ;
                })

                ->addColumn('action', function ($row) {
                    return view('dashboard.product.components.action',['id' => $row->_id])->render();
                })
                ->rawColumns(['action','imageCover','description','availability','price','title'])
                ->make(true);
        }
        return  view('dashboard.product.index');

    }

    public function create()
    {
        return view('dashboard.product.create');
    }

    public function store(ProductRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $product = new Product([
                'title' => $validatedData['title'],
                'description'=>$validatedData['description'],
                'discount' =>(int) $validatedData['discount'],
                'ratingsQuantity' => (int)$validatedData['ratingsQuantity'],
                'ratingsAverage'=>4.5,
                'stockQuantity'=>(int)$validatedData['stockQuantity'],
                'price' => (double)$validatedData['price'],
                'brand' => $validatedData['brand'],
                'imageCover' => $validatedData['imageCover'],
                'availability'=>true,
                'images' => $validatedData['images'],// Assign the entire images array
            ]);

            $product->save();

            $response = [
                'success' => true,
                'message' => 'تم اضافة المنتج بنجاح!',
                'data' => $product,
            ];

            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 403);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 403);
        }
    }


    public function show($id)
    {
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Assuming you have a Product model

        return view('dashboard.product.edit', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();

            $product = Product::findOrFail($id);
            $product->title = $validatedData['title'];
            $product->description = $validatedData['description'];
            $product->discount = (int) $validatedData['discount'];
            $product->ratingsQuantity = (int) $validatedData['ratingsQuantity'];
            $product->ratingsAverage = 4.5;
            $product->stockQuantity = (int) $validatedData['stockQuantity'];
            $product->price = (double) $validatedData['price'];
            $product->brand = $validatedData['brand'];
            $product->imageCover = $validatedData['imageCover'];
            $product->images = $validatedData['images']; // Assign the entire images array
            $product->availability = $request->has('availability'); // true if checked, false if not checked
            $product->save();

            $response = [
                'success' => true,
                'message' => 'تم تحديث المنتج بنجاح!',
                'data' => $product,
            ];

            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 403);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 403);
        }
    }
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['code' => 200, 'message' => 'تم الحذف بنجاح'], 200);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 403);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 403);
        }
    }
}
