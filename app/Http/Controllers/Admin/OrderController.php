<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $todayData =  Carbon::now();
        $data['orders'] = Order::whereDate('created_at',$todayData)->paginate(10);
        return view('admin.orders.index',$data);
    }
}
