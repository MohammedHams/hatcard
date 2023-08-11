<?php

namespace App\Http\Controllers\Agent;

use App\Http\Requests\NetworkRequest;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Network;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request; // Corrected the import here
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use MongoDB\BSON\ObjectId;
use Carbon\Carbon;
class NetworkController extends Controller
{
    public function index(Request $request)
    {
      if ($request->ajax()&& !$request->has('is_view')) {
          $row = Network::where('owner_id', new ObjectId(Auth::id()))
              ->select(['_id', 'name', 'city', 'area', 'cover', 'status', 'createdAt'])->get();
          return DataTables::of($row)
                ->addColumn('cover', function ($row) {

                    $imageUrl = asset($row->cover);

                    return '<img src="' . $imageUrl . '" alt="Static Image" width="100" height="50">';
                })
              ->addColumn('city_name', function ($row) {
             $area = City::find($row->city);
                  return $area ? $area->name : 'N/A';
              })
              ->addColumn('area_name', function ($row) {
                  $area = Area::find($row->area);
                  return $area ? $area->name : 'N/A';
              })
                ->editColumn('status', function ($row) {
                    $column = "";
                    if ($row->status == 'approved') {
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>تمت الموافقة</span>";
                    }
                    else if ($row->status == 'pending') {
                        $column = "<span class='badge badge-light-warning' style='font-size: 14px'>قيد المراجعة </span>";
                    }
                    else if($row->status == 'rejected')  {
                        $column = "<span class='badge badge-light-danger' style='font-size: 14px'>مرفوض </span>";
                    }
                    return $column;
                })
                ->editColumn('createdAt', function ($row) {
                    $carbonDate = Carbon::parse($row->createdAt);
                    $formattedDate = $carbonDate->format('Y-m-d');
                    return $formattedDate;
                })
                ->addColumn('action', function ($row) {
                    return view('dashboard.network.components.action', ['id' => $row->_id,'network_name'=>$row->name])->render();
                })
                ->rawColumns(['cover', 'action','status','createdAt','city_name','area_name'])
                ->make(true);
        }

        return view('dashboard.network.index');
    }


    public function show($id)
    {
        $network = Network::findOrFail($id);

        return view('dashboard.network.show', compact('network'));
    }
    public function create()
    {
        $cities = City::all();
return view('dashboard.network.create',compact('cities'));
    }


    public function store(NetworkRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $ownerId = Auth::id();

            $network = new Network([
                'name' => $validatedData['name'],
                'owner' => $validatedData['owner'],
                'phone' => $validatedData['phone'],
                'city' => $validatedData['city'],
                'area' => $validatedData['area'],
                'url' => $validatedData['url'],
                'owner_id' => $ownerId,
            ]);

            $network->save();

            if ($request->hasFile('cover')) {
                $fileExtension = $request->file('cover')->getClientOriginalExtension();

                $directory = 'imgs/networks/network-' . $network->_id;

                $fileName = 'imageCover.' . $fileExtension;
                $request->file('cover')->move(public_path($directory), $fileName);


                $network->update(['cover' => $directory . '/' . $fileName]);
            }

            $socialMediaLinks = [
                'facebook' => $validatedData['facebook'] ? 'https://www.facebook.com/' . $validatedData['facebook'] : null,
                'instagram' => $validatedData['instagram'] ? 'https://www.instagram.com/' . $validatedData['instagram'] : null,
                'webUrl' => $validatedData['webUrl'],
            ];

            $network->update(['socialMediaLinks' => $socialMediaLinks]);

            $response = [
                'success' => true,
                'message' => 'تم اضافة الشبكة بنجاح!',
                'data' => $network, // Optionally, you can send back the newly created network data in the response
            ];

            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        $cities = City::all();
        $network = Network::findOrFail($id);
        return view('dashboard.network.edit',compact('id','network','cities'));
    }

    public function update(NetworkRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $network = Network::findOrFail($id);
            $ownerId = new ObjectId(Auth::id());
            if ((string) $network->owner_id !== (string) $ownerId) {
                return response()->json(['success' => false, 'message' => 'You do not have permission to update this network.'], 403);
            }

        if($request->status){
            $network->update([
                'name' => $validatedData['name'],
                'owner' => $validatedData['owner'],
                'phone' => $validatedData['phone'],
                'url' => $validatedData['url'],
                'status'=>$request->status,
                ]);

        }else{
            $network->update([
                'name' => $validatedData['name'],
                'owner' => $validatedData['owner'],
                'phone' => $validatedData['phone'],
                'url' => $validatedData['url'],
            ]);

        }
            if ($request->hasFile('cover')) {
                $fileExtension = $request->file('cover')->getClientOriginalExtension();
                $directory = 'imgs/networks/network-' . $network->_id;
                $fileName = 'imageCover.' . $fileExtension;
                $request->file('cover')->move(public_path($directory), $fileName);
                $network->update(['cover' => $directory . '/' . $fileName]);
            }

            $socialMediaLinks = [
                'facebook' => $validatedData['facebook'] ? 'https://www.facebook.com/' . $validatedData['facebook'] : null,
                'instagram' => $validatedData['instagram'] ? 'https://www.instagram.com/' . $validatedData['instagram'] : null,
                'webUrl' => $validatedData['webUrl'],
            ];

            $network->update(['socialMediaLinks' => $socialMediaLinks]);

            $response = [
                'success' => true,
                'message' => 'تم تحديث الشبكة بنجاح!',
                'data' => $network,
            ];

            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
    }
    public function getAreaByCityId($cityId)
    {
        $cityId = new ObjectId($cityId);
        $areas = Area::where('city', $cityId)->get();
        return response()->json($areas);
    }
}
