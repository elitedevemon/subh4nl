<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
class Menu extends Component
{

	public $idS;

	public function mount($catId)
	{
		$this->idS = $catId;
	}


    public function render()
    {
    	$ne = \App\Models\SubCategory::where('category_id', $this->idS)
    	                                      ->withCount('products')
                                              ->latest('products_count')
                                              ->with('products')
                                              ->where('status', 1)
                                              ->get();
        return view('livewire.menu', compact('ne'));
    } 


   
}
