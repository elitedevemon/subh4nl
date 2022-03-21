<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Offer;
class OfferDetails extends Component
{
	public $getData;
	protected $listeners = ['getOfferDetails' => 'getOfferDetails'];


	public function getOfferDetails($id)
	{
		// dd('d');
		$this->getData = Offer::find($id);
		$this->dispatchBrowserEvent('show-modal234');
	}
    public function render()
    {
        return view('livewire.offer-details');
    }
}
