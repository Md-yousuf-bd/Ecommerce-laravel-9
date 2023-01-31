<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class View extends Component
{
    public $category, $product, $productColorSelectedQuantity, $productId, $quantityCount = 1, $productColorId;

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already Added to wishlist.',
                    'type' => 'success',
                    'status' => 409
                ]);
                return false;
            } else {
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'wishlist Added Successfully.',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to continue.',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->productColorSelectedQuantity =  $productColor->quantity;
        if ($this->productColorSelectedQuantity == 0) {
            $this->productColorSelectedQuantity = 'outOfStock';
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }
    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function addToCard(int $ProductId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $ProductId)->where('status', '0')->exists()) {
                //check for Product color quantity and add to cart
                if ($this->product->productColors()->count() > 1) {
                    if ($this->productColorSelectedQuantity != NULL) {
                        if (Cart::where('user_id', Auth::user()->id)->where('product_id', $ProductId)->where('product_color_id', $this->productColorId)->exists()) {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Already added',
                                'type' => 'warning',
                                'status' => 200
                            ]);
                        } else {

                        $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                        if ($productColor->quantity > 0) {
                            if ($productColor->quantity > $this->quantityCount) {
                                //inset product to card
                                Cart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $ProductId,
                                    'product_color_id' => $this->productColorId,
                                    'quantity' => $this->quantityCount
                                ]);
                                 $this->emit('cartAddedUpdate');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product added to cart Success',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'only' . $this->product->quantity . ' Quantity available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Oue of stock',
                                'type' => 'info',
                                'status' => 404
                            ]);
                        }
                    }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select your product Color',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    }
                } else {

                    if (Cart::where('user_id', Auth::user()->id)->where('product_id', $ProductId)->exists()) {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Already Added',
                            'type' => 'warning',
                            'status' => 200
                        ]);
                    } else {


                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity > $this->quantityCount) {
                                Cart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $ProductId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->emit('cartAddedUpdate');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product added to cart Success',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'only' . $this->product->quantity . 'Quantity available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Does not exists',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to add to card',
                'type' => 'danger',
                'status' => 401
            ]);
        }
    }



    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->category,
        ]);
    }
}
