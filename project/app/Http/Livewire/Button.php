<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shipping;
class Button extends Component
{
    public $alertHide = true;
    public $km;

    public $getOrder;

    public function mount()
    {
        $this->getOrder = session('orderPart');
        // dd($getOrder);
    }
    protected $listeners = ['showAlertMsg' => 'showAlertMsg'];

    public function showAlertMsg($value)
    {
        $this->alertHide = false;
        $this->km = $value;
    }

    public function render()
    {
        return view('livewire.button');
    }
}
