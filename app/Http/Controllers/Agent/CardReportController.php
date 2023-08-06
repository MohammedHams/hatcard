<?php

namespace App\Http\Controllers\Agent;

use App\Models\CardReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use Yajra\DataTables\DataTables;

class CardReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() && !$request->has('is_view')) {

            $userReports = CardReport::where('user', new ObjectId(Auth::id()))->get();
            return DataTables::of($userReports)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'unpaid') {
                        $column = "<span class='badge badge-light-danger' style='font-size: 14px'>مستحق</span>";
                    } else {

                        $column = "<span class='badge badge-light-success'style='font-size: 14px'>تم الدفع</span>";
                    }
                    return $column;
                })
                ->editColumn('category', function ($userReports) {
                        $cname =  $userReports->categoryCard->cname ;
                        return $cname;
                })
                ->editColumn('network_id', function ($userReports) {

                        $netname = $userReports->network->name;
                        return $netname;
                })
                ->editColumn('createdAt', function ($row) {
                    $carbonDate = Carbon::parse($row->createdAt);
                    $formattedDate = $carbonDate->format('Y-m-d');
                    return $formattedDate;
                })

                ->rawColumns(['status','category','network_id','createdAt'])
                ->make(true);

        }
        return view('dashboard.card-report.index');

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
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
