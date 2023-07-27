<?php

namespace App\Http\Controllers\Agent;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Network;
use Illuminate\Http\Request; // Corrected the import here
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
class NetworkController extends Controller
{
    public function index(Request $request)
    {

        $ownerId = new ObjectId(Auth::id());
        if ($request->ajax()) {

            $row = Network::where('owner_id', $ownerId)
                ->select(['_id', 'name','owner', 'phone'])
                ->get();


            return DataTables::of($row)
                ->addColumn('action', function ($row) {
                    return view('dashboard.network.components.action', ['row' => $row])->render();
                })
                ->rawColumns(['action'])
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
return view('dashboard.network.create');
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
