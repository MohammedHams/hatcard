<?php

namespace App\Http\Controllers\Agent;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Network;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request; // Corrected the import here
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use MongoDB\BSON\ObjectId;
class NetworkController extends Controller
{
    public function index(Request $request)
    {
      if ($request->ajax()&& !$request->has('is_view')) {
            $row = Network::where('owner_id', new ObjectId(Auth::id()))
                ->select(['_id', 'name', 'owner', 'phone','cover'])
                ->get();

            return DataTables::of($row)
                ->addColumn('image', function ($row) {

                    $imageUrl = asset($row->cover);

                    // Replace 'your_static_image_url' with the actual URL of the image you want to display.
                    return '<img src="' . $imageUrl . '" alt="Static Image" width="200">';
                })
                ->addColumn('action', function ($row) {
                    return view('dashboard.network.components.action', ['id' => $row->_id])->render();
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('dashboard.network.index');
    }


    public function show($id)
    {
        // Fetch the specific network record based on the given $id
        $network = Network::findOrFail($id);

        // You can add any additional logic here if needed

        // Return the view to display the specific network details
        return view('dashboard.network.show', compact('network'));
    }
    public function create()
    {
        $cities = City::all();
return view('dashboard.network.create',compact('cities'));
    }


    public function store(Request $request)
    {
        try {
            // Validate the incoming request data, including image file and URL
            $validatedData = $request->validate([
                'name' => 'required|max:500',
                'owner' => 'required|max:500',
                'phone' => 'required|numeric|digits:10|phone_format',
                'city' => 'required',
                'area' => 'required',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the max file size as needed
                'url' => 'required|url',
                'facebook' => 'nullable|string|max:500',
                'instagram' => 'nullable|string|max:500',
                'webUrl' => 'nullable|url|max:500',
            ]);

            // Get the authenticated user's ID
            $ownerId = Auth::id();

            // Create a new network instance with basic details
            $network = new Network([
                'name' => $validatedData['name'],
                'owner' => $validatedData['owner'],
                'phone' => $validatedData['phone'],
                'city' => $validatedData['city'],
                'area' => $validatedData['area'],
                'url' => $validatedData['url'],
                'owner_id' => $ownerId,
            ]);

            // Save the new network record to the collection
            $network->save();

            // Handle the image file upload if provided
            if ($request->hasFile('cover')) {
                // Get the file extension
                $fileExtension = $request->file('cover')->getClientOriginalExtension();

                // Define the directory where the file will be stored
                $directory = 'imgs/networks/network-' . $network->_id;

                // Save the image file to the specified directory
                $fileName = 'imageCover.' . $fileExtension;
                $request->file('cover')->move(public_path($directory), $fileName);


                // Update the network record with the image URL
                $network->update(['cover' => $directory . '/' . $fileName]);
            }

            // Handle social media links if provided
            $socialMediaLinks = [
                'facebook' => $validatedData['facebook'] ? 'https://www.facebook.com/' . $validatedData['facebook'] : null,
                'instagram' => $validatedData['instagram'] ? 'https://www.instagram.com/' . $validatedData['instagram'] : null,
                'webUrl' => $validatedData['webUrl'],
            ];

            // Update the network record with the social media links
            $network->update(['socialMediaLinks' => $socialMediaLinks]);

            $response = [
                'success' => true,
                'message' => 'تم اضافة الشبكة بنجاح!',
                'data' => $network, // Optionally, you can send back the newly created network data in the response
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
    public function edit($id)
    {
        $cities = City::all();
        $network = Network::findOrFail($id);
        return view('dashboard.network.edit',compact('id','network','cities'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request data, including image file and URL
            $validatedData = $request->validate([
                'name' => 'required|max:500',
                'owner' => 'required|max:500',
                'phone' => 'required|numeric|digits:10|phone_format',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the max file size as needed
                'url' => 'required|url',
                'facebook' => 'nullable|string|max:500',
                'instagram' => 'nullable|string|max:500',
                'webUrl' => 'nullable|url|max:500',
            ]);

            // Find the network record by ID
            $network = Network::findOrFail($id);

            // Check if the authenticated user owns this network
            $ownerId = new ObjectId(Auth::id());
            if ((string) $network->owner_id !== (string) $ownerId) {
                return response()->json(['success' => false, 'message' => 'You do not have permission to update this network.'], 403);
            }


            // Update the network record with the new data
            $network->update([
                'name' => $validatedData['name'],
                'owner' => $validatedData['owner'],
                'phone' => $validatedData['phone'],
                'url' => $validatedData['url'],
            ]);

            // Handle the image file upload if provided
            if ($request->hasFile('cover')) {
                // Get the file extension
                $fileExtension = $request->file('cover')->getClientOriginalExtension();

                // Define the directory where the file will be stored
                $directory = 'imgs/networks/network-' . $network->_id;

                // Save the image file to the specified directory
                $fileName = 'imageCover.' . $fileExtension;
                $request->file('cover')->move(public_path($directory), $fileName);

                // Update the network record with the new image URL
                $network->update(['cover' => $directory . '/' . $fileName]);
            }

            // Handle social media links if provided
            $socialMediaLinks = [
                'facebook' => $validatedData['facebook'] ? 'https://www.facebook.com/' . $validatedData['facebook'] : null,
                'instagram' => $validatedData['instagram'] ? 'https://www.instagram.com/' . $validatedData['instagram'] : null,
                'webUrl' => $validatedData['webUrl'],
            ];

            // Update the network record with the social media links
            $network->update(['socialMediaLinks' => $socialMediaLinks]);

            $response = [
                'success' => true,
                'message' => 'تم تحديث الشبكة بنجاح!',
                'data' => $network, // Optionally, you can send back the updated network data in the response
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


    public function destroy($id)
    {
    }
    // Example controller method to fetch areas based on city ID
// Example controller method to fetch areas based on city ID
    public function getAreaByCityId($cityId)
    {
        $cityId = new ObjectId($cityId);
        $areas = Area::where('city', $cityId)->get();
        return response()->json($areas);
    }
}
