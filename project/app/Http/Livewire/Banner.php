<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
class Banner extends Component
{

    public function render()
    {
    	$banner = Product::where('status', 1)
                         ->where('is_banner', 1)
                         ->get();
        return view('livewire.banner', compact('banner'));
    }



}
