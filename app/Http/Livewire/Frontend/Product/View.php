<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class View extends Component
{
    public $category, $product, $productColorSelectedQuantity, $productId;

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                // session()->flash('message', 'Already Added to wishlist');
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
                // session()->flash('message','wishlist Added Successfully.');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'wishlist Added Successfully.',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            // session()->flash('message', 'Please Login to continue.');
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
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->productColorSelectedQuantity =  $productColor->quantity;
        if ($this->productColorSelectedQuantity == 0) {
            $this->productColorSelectedQuantity = 'outOfStock';
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
