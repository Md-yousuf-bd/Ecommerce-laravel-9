<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistShow extends Component
{
    public function render()
    {
         $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist' => $wishlist
        ]);
    }
    public function removeWishlist(int $wishlistId){
        Wishlist::where('user_id', Auth::user()->id)->where('id',$wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist Item Remove Successfully..',
            'type' => 'success',
            'status' => 200
        ]);
    }
}
