<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use App\Order;
class DashboardController extends Controller
{
    public function index()
    {
        $orderscount =Order::count();
        return view('dashboard.home.index',compact('orderscount'));
    }

  
}