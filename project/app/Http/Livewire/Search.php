<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
class Search extends Component
{
	public $categoryProduct;

	public function mount($query)
	{
		$this->categoryProduct = $query;
	}
    public function render()
    {
    	$category = Category::withCount('products')
                                   ->latest('products_count')
                                   ->where('status', 1)
                                   ->get();
        return view('livewire.search', compact('category'));
    }
}
