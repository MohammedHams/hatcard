<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Distributor;
use App\Http\Requests\BalanceRequest;
use App\Models\Balance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class BalancesController extends Controller
{

    public function index(Request $request)
    {
        $userId = new ObjectId(Auth::id());
        if ($request->ajax()&& !$request->has('is_view')) {
            $row = Balance::where('receiver', $userId)->orWhere('sender', $userId)->orderBy('createdAt')->get();

            return DataTables::of($row)

                ->editColumn('receiver',function ($row){
                  return  $row->receiverUser->phone;
                })
                ->editColumn('sender',function ($row){
                    return  $row->senderUser->phone;
                })
                ->editColumn('operationType',function ($row){
                    if($row->operationType =='D'){
                        $column = "<span class='badge badge-light-primary' style='font-size: 14px'>مباشر</span>";
                    }else if($row->operationType =='T'){
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>تحويل أرصدة</span>";
                    }else if($row->operationType =='C'){
                        $column = "<span class='badge badge-light-success' style='font-size: 14px'>كوبون</span>";
                    }else if($row->operationType =='R'){
                        $column = "<span class='badge badge-light-danger' style='font-size: 14px'>مرجع</span>";
                    }
                    return  $column;
                })
                ->addColumn('action', function ($row) {
                    return view('dashboard.balance.components.action')->render();
                })
                ->rawColumns(['receiver','operationType'])
                ->make(true);
        }
        return  view('dashboard.balance.index');

    }

    public function store(BalanceRequest $request)
    {
        $userId = new ObjectId(Auth::id());
        $userPhone = Auth::user()->phone;
        $receiver = $request->input('receiver');
        $receiver_confirm = $request->input('receiver_confirm');
        $balance = $request->input('balance');
        $masterID = env('MASTERID');
        if($receiver !== $receiver_confirm){
            return response()->json([
                'error' => true,
                'code' => 403,
                'message' => 'الرقم غير متطابق!',
            ], 403);

        }
        if ($receiver === $userPhone) {
            return response()->json([
                'error' => true,
                'code' => 403,
                'message' => 'حدث خطأ! لا يمكنك تحويل رصيد الى هذا الرقم',
            ], 403);
        }




        DB::beginTransaction();
        try {
            // Your transaction methods
            $userReceiver = User::where([
                ['_id', '<>', $masterID],
                ['phone', $receiver],
            ])->select('balance', 'role')->first();
            $sender = User::where('_id', $userId)
                ->select('balance', 'role')
                ->first();

            if (!$userReceiver) {
                return response()->json([
                    'error' => true,
                    'code' => 403,
                    'message' => 'لا يوجد مستخدم !',
                ], 403);
            }

            if ($sender->balance <= 0 || $balance > $sender->balance) {
                return response()->json([
                    'error' => true,
                    'code' => 403,
                    'message' => 'ليس لديك رصيد كافي للتحويل!',
                ], 403);
            }

            // Authorization logic based on role hierarchy
            $roleHierarchy = [
                'user' => 1,
                'agent' => 2,
                'distributor' => 3,
                'admin' => 4,
            ];

            if ($roleHierarchy[$sender->role] < $roleHierarchy[$userReceiver->role]) {
                return response()->json([
                    'error' => true,
                    'code' => 403,
                    'message' => 'غير مسموح لك بتحويل الرصيد إلى هذا المستخدم!',
                ], 403);
            }

            $userReceiver->balance += $balance;
            $sender->balance -= $balance;

            if ($userReceiver->isDirty()) {
                $currentTimestamp = time();

                $randomNumber = substr(round(microtime(true) * 1000), -6);
                $operationType = ($userId == $masterID) ? 'D' : 'T';

                $balanceOperation = new Balance([
                    'operationNumber' => $randomNumber,
                    'balance' => (int)$balance,
                    'receiver' => new objectId($userReceiver->_id),
                    'operationType' => $operationType,
                    'sender' => $userId,
                ]);

                $sender->save(['session' => session()]);
                $userReceiver->save(['session' => session()]);
                $balanceOperation->save(['session' => session()]);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'تم تحويل الرصيد بنجاح.',
                ], 200);
            }
        }  catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'failed',
                    'message' => $e->getMessage(),
                ], 403);
            }

    }



    public function create()
    {
        return view('dashboard.balance.create');
    }

    public function show(Balance $balance)
    {
    }

    public function edit(Balance $balance)
    {
    }

    public function update(Request $request, Balance $balance)
    {
    }

    public function destroy(Balance $balance)
    {
    }
}
