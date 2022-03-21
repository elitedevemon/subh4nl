<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
class BannerV1 extends Component
{



	public function mount()
	{
	
	}

    public function render()
    {
    	$banner = Product::where('status', 1)
                         ->where('is_banner', 1)
                         ->get();

		$deal= Product::where('status', 1)
                         ->where('is_pro', 2)
                         ->get();
        return view('livewire.banner-v1', compact('banner', 'deal'));
    }
}
