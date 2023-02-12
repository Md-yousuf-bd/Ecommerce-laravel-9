<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;
    public $fullName, $email, $phone, $pinCode , $address, $payment_mode = NULL, $payment_id = NULL;

    public function rules(){
        return [
            'fullName' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|min:11',
            'pinCode' => 'required|string|min:6',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder(){
        $validatedData = $this->validate();
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'tracking_no' => 'yousuf'.Str::random(10),
            'fullName' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'pinCode' => $this->pinCode,
            'address' => $this->address,
            'status_massage' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);
        foreach ($this->carts as $cartItem){

            $orderItems = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id'  => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);
            // $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            if($cartItem->product_color_id != NULL){
                $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            }else{
                $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
            }
        }
        return $order;
    }

    public function codOrder(){
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder){
            Cart::where('user_id', Auth::user()->id)->delete();

            session()->flash('message','Placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    public function totalProductAmount(){
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id',Auth::user()->id)->get();
        foreach($this->carts as $cartItem ){
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullName = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
