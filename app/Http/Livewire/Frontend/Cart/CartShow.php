<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function PHPSTORM_META\elementType;

class CartShow extends Component
{
    public $cart , $totalPrice = 0;


    //decrement function
    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', Auth::user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($cartData->quantity != 0) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Already ' . $cartData->quantity ,
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if ( $cartData->quantity != 0) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {

                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Already ' . $cartData->quantity ,
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    //increment function
    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', Auth::user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only' . $productColor->quantity . 'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only' . $cartData->product->quantity . 'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    //remove function
    public function removeCartItem(int $cartId){
       $cartRemoveData = Cart::where('user_id', Auth::user()->id)->where('id',$cartId)->first();
       if($cartRemoveData){
        $cartRemoveData->delete();
        $this->dispatchBrowserEvent('message', [
            'text' => 'Cart Items Remove successfully',
            'type' => 'success',
            'status' => 200
        ]);
       }else{
        $this->dispatchBrowserEvent('message', [
            'text' => 'Something Went Wrong',
            'type' => 'error',
            'status' => 404
        ]);
       }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
