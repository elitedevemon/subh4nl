<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;
class MainMenu extends Component
{

    use WithPagination;

      protected $paginationTheme = 'bootstrap';

    public function render()
    {
    	$categoryProduct = Product::where('sub_category_id', 0)
                                          ->orderBy('id', 'DESC')
                                          ->where('status', 1)
                                          ->inRandomOrder()
                                          ->paginate(9);
      $category = Category::withCount('products')
                                   ->latest('products_count')
                                   ->where('status', 1)
                                   ->get();

        return view('livewire.main-menu', compact('category','categoryProduct'));
    }


}
