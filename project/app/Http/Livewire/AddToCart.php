<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\setting;
class AddToCart extends Component
{
	protected $listeners = ['addToCart' => 'addToCart'];
	public $product_id;
    public $getTo = [];

    public $total = 0;
    public $withoutOfferPrice;
    public $offerLimit;



    public function render()
    {
        return view('livewire.add-to-cart');
    }

    public function getWithoutOfferPrice()
    {
        $ss = setting::find(1);
        $this->offerLimit = $ss->offer_limit;

        $offerPrice = 0;
        if(session('cart')){
            $qq = session('cart');
            foreach(session('cart') as $id => $details){
                if ($details['is_pro'] == 1) {
                    $offerPrice += $details['price'] * $details['quantity'];
                }
            }
        }
        $this->withoutOfferPrice = $offerPrice;
    }
     public function addToCart($id)
    {


    	$this->product_id = $id;
    	$NewSub = 0;
        $getPro =Product::find($this->product_id);
        $cart = session()->get('cart');

        if ($getPro->is_promo == 1) {
                $price = $getPro->offer_price;
        }else{
            $price = $getPro->regular_price;
        }
        $extraPrice = $price;

        if(isset($cart[$this->product_id])) {
            $cart1 = session()->get('cart');
                if(isset($cart1[$this->product_id])) {
                    $cart1[$this->product_id]['quantity']++;
                    session()->put('cart', $cart1);
                }

                        $offer = session()->get('cart');
                        $ss1 = setting::find(1);

                        if($ss1->is_offer2 == 1){
                            if ($getPro->is_pro == 2) {
                                if(isset($offer[$id])){

                                    if ($offer[$id]['quantity'] >= intval($getPro->sale_limit)) {

                                         $def = $id;
                                         $def .= 1000;

                                        $sale = \App\Models\Sale::where('product_id', $offer[$id])->get();


                                             $cart = session()->get('cart');
                                             foreach ($sale  as $key => $offerSale) {
                                                 $cart[$def] = [
                                                    "id" =>  $def,
                                                    "name" => $offerSale->name,
                                                    "quantity" => 1,
                                                    "price" => 00,
                                                    "extraPrice" => 00,
                                                    "img" => $offerSale->img,
                                                    "select" =>null,
                                                    "g_paid" =>null,
                                                    "is_show" => null,
                                                    "is_paid" => null,
                                                    "product_type" => null,
                                                    "is_offer" => 2,
                                                    "is_pro" => 1,
                                                    "discountable" => 0,
                                                    "pro_id" => $id,
                                                ];
                                             }
                                            session()->put('cart', $cart);
                                    }
                                }
                            }
                        }

        }else{

            $cart[$this->product_id] = [
                    "id" => $getPro->id,
                    "name" => $getPro->name,
                    "quantity" => 1,
                    "price" => $extraPrice,
                    "extraPrice" => $NewSub,
                    "img" => $getPro->image,
                    "select" =>null,
                    "g_paid" =>null,
                    "is_show" => null,
                    "is_paid" => null,
                    "is_offer" => null,
                    "is_pro" => $getPro->is_pro,
                    "product_type" => null,
                    "discountable" => intval($getPro->discountable),
                ];
                // dd($cart);
                session()->put('cart', $cart);

                 $offer = session()->get('cart');
                        $ss1 = setting::find(1);

                        if($ss1->is_offer2 == 1){
                            if ($getPro->is_pro == 2) {
                                if(isset($offer[$id])){

                                    if ($offer[$id]['quantity'] >= intval($getPro->sale_limit)) {
                           

                                         $def = $id;
                                         $def .= 1000;

                                        $sale = \App\Models\Sale::where('product_id', $offer[$id])->get();


                                             // $cart = session()->get('cart');
                                             foreach ($sale  as $key => $offerSale) {
                                                 $offer[$def] = [
                                                    "id" =>  $def,
                                                    "name" => $offerSale->name,
                                                    "quantity" => 1,
                                                    "price" => 00,
                                                    "extraPrice" => 00,
                                                    "img" => $offerSale->img,
                                                    "select" =>null,
                                                    "g_paid" =>null,
                                                    "is_show" => null,
                                                    "is_paid" => null,
                                                    "product_type" => null,
                                                    "is_offer" => 2,
                                                    "is_pro" => 1,
                                                    "discountable" => 0,
                                                    "pro_id" => $id,
                                                ];
                                             }
                                            session()->put('cart', $offer);
                                    }
                                }
                            }
                        }

        }

                $this->emit('updateCartCount');
                $this->emit('updateSideCartCount');
                $this->getWithoutOfferPrice();
                if ($this->withoutOfferPrice >= $this->offerLimit) {
                    $ss1 = setting::find(1);
                    if($ss1->is_offer1 == 1){
                        // dd('off');
                        $this->emit('getAOffer');
                    }
                }
                $this->alertForProduct();
                $this->dispatchBrowserEvent('hide-modal');
    }

    public function alertForProduct()
    {
         $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Ajouter un Panier!',
                // 'text' => 'It will list on users table soon.'
            ]);
    }
}
