<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $data['orders'] = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('frontend.orders.index',$data);
    }

    public function view($orderId){
        $data['order'] = Order::where('user_id',Auth::user()->id)->where('id',$orderId)->first();
        if($data){
            return view('frontend.orders.view',$data);
        }else{
            return redirect()->back()->with('message','No Order found');
        }
    }
}
