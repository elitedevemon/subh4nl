<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CatProduct extends Component
{
	public $catPro;

	public function mount($catPro)
	{
		$this->catPro = $catPro;
	}
    public function render()
    {
        return view('livewire.cat-product');
    }
}
