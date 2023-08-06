<?php

namespace App\Http\Controllers\Agent;
use App\Models\Card;
use App\Models\CategoryCard;
use App\Models\CardReport;
use MongoDB\BSON\ObjectId;
use App\Http\Controllers\Controller;
use App\Models\Network;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = new ObjectID(Auth::id());
        $userNetworkIds = Network::where('owner_id', $userId)->pluck('_id');
        $userNetworkIds = $userNetworkIds->map(function ($id) {
            return new ObjectID($id);
        });
        $totalSales = Order::whereIn('network', $userNetworkIds)->sum('totalPrice');
        $totalPaidCards = Order::whereIn('network', $userNetworkIds)->get()->sum(function ($order) {
            return count($order['cards']);
        });

        $totalCategory = CategoryCard::whereIn('network', $userNetworkIds)->count();
        $totalCard = Card::whereIn('network', $userNetworkIds)->count();
        $totalUploadedCard = CardReport::whereIn('network', $userNetworkIds)->sum('quantity');
        $totalNetworks = $userNetworkIds->count();
        return view('dashboard.index', compact('totalSales', 'totalNetworks','totalCategory','totalCard','totalPaidCards','totalUploadedCard'));
    }



}
