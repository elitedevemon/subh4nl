<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
class Deal extends Component
{
    public function render()
    {
    	$deal = Product::where('status', 1)
                         ->where('is_pro', 2)
                         ->get();
        return view('livewire.deal', compact('deal'));
    }
}
