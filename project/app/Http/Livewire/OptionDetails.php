<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductOption;
class OptionDetails extends Component
{
	public $getData;
	protected $listeners = ['getOpDetailsClick' => 'getOpDetailsClick'];


	public function getOpDetailsClick($id)
	{
		// dd($id);
		$this->getData = ProductOption::find($id);
		// $this->dispatchBrowserEvent('show-modal23');
	}
    public function render()
    {
        return view('livewire.option-details');
    }

}
