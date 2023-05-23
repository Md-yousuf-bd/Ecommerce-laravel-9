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
        // $todayData =  Carbon::now();
        $todayData =  '2023-02-09';
        $data['order'] = Order::whereDate('created_at',$todayData)->get();
        // dd($data);
        return view('admin.orders.index',$data);
    }
}
