<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
class CustomProduct extends Component
{

  use WithPagination;
  protected $paginationTheme = 'bootstrap';
	public $getCatSlug;

	public function mount($slug)
	{
		$this->getCatSlug = $slug;
	}

    public function render()
    {
    	$cat = Category::where('slug', $this->getCatSlug)->first();
      $apps = $cat->products()->paginate(9);
    	$category = Category::withCount('products')
                                   ->latest('products_count')
                                   ->where('status', 1)
                                   ->get();
        return view('livewire.custom-product', compact('cat', 'category','apps'));
    }
}
