<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
class ProductDetails extends Component
{
	public $getData;
	protected $listeners = ['getDetails' => 'getDetails'];


	public function getDetails($id)
	{
		// dd('d');
		$this->getData = Product::find($id);
	}
    public function render()
    {
        return view('livewire.product-details');
    }
}
