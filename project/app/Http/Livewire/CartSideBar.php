<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartSideBar extends Component
{
	public $show = false;

    public $count = 0;
    public $total = 0;
    public $cartProduct = [];

    protected $listeners = ['updateSideCartCount' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->count = $this->getCount();
        // $this->cartProduct = $this->getProduct();

        if ($this->count > 0) {
            $this->show = true;
        } else {
            $this->show = false;
        }
        $this->getTotal();
    }

    public function getCount()
    {
        $cartCount = count((array) session('cart'));
        return $cartCount;
    }
   //  public function getProduct()
   //  {
   //  	if(session('cart')){

   //  		$this->cartProduct = session('cart');
			// return $this->cartProduct;

   //  	}
   //  }

    public function getTotal()
    {
    	$NewSub = 0;
    	if(session('cart')){
            foreach(session('cart') as $id => $details){

            	$price = $details['price'] + $details['extraPrice'];

                $NewSub += $price * $details['quantity'];

            }

        }

        $this->total = $NewSub;

    }
    public function render()
    {
        return view('livewire.cart-side-bar');
    }

    // public function removeCart($id = null)
    // {
    //     if($id) {
    //         $cart = session()->get('cart');
    //         if(isset($cart[$id])) {
    //             unset($cart[$id]);
    //             session()->put('cart', $cart);
    //         }
    //         // session()->flash('success', 'Product removed successfully');
    //     }
    //     $this->updateCount();
    //     $this->emit('updateCartCount');
    //      // $this->mount();
    //      $this->getTotal();

    // }
}
