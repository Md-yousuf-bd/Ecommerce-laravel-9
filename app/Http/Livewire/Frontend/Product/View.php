<?php

namespace App\Http\Livewire\Frontend\Product;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $productColorSelectedQuantity, $productId;

    public function addToWishList($productId){
        if(Auth::check())
        {
            dd(111);

        }
        else
        {
            session()->flash('message','Please Login to continue.');
            return false;
        }
    }

    public function colorSelected($productColorId){
        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->productColorSelectedQuantity =  $productColor->quantity;
        if($this->productColorSelectedQuantity == 0){
            $this->productColorSelectedQuantity = 'outOfStock';
        }
    }

    public function mount($category, $product){
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'product' => $this->category,
        ]);
    }
}
