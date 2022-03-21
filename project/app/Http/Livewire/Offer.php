<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Offer as offerP;
use App\Models\setting;
class Offer extends Component
{

	public $total;
    public $isShow = 50;
	public $isShowOp;
    public $singleV;
    public $offer_limit;

    protected $listeners = ['getAOffer' => 'getAOffer'];
	public function mount()
	{
        $this->getTotal();
		$this->openOffer();
	}


    public function openOffer()
    {
        $this->dispatchBrowserEvent('offer-product-Model');
    }


    public function getAOffer()
    {
        // dd('offer');

        $ss = setting::find(1);
        $this->offer_limit = $ss->offer_limit;
        // dd('ff');
        $NewSub = 0;
        if(session('cart')){
            $qq = session('cart');
            foreach(session('cart') as $id => $details){
                $NewSub += $details['price'] * $details['quantity'];

                // $qq += $details['price'] * $details['quantity'];
            }
        }
        // dd($NewSub);


           $isOffer = session()->get('isOffer');
        if ($NewSub < $this->offer_limit) {

            $isOffer = ['is_offer' => 2];
            $isOffer = session()->put('isOffer', $isOffer);
        }else{


           // if ($isOffer['is_offer'] !== 1) {
           //     $isOffer = ['is_offer' => null];
           //      $isOffer = session()->put('isOffer', $isOffer);
           //  }

            // dd($isOffer);
            if($isOffer == null)  {
                $isOffer = ['is_offer' => null];
                $isOffer = session()->put('isOffer', $isOffer);
            }elseif ($isOffer['is_offer'] !== 1) {
               $isOffer = ['is_offer' => null];
                $isOffer = session()->put('isOffer', $isOffer);
            }

            // $isOf = session()->get('isOffer');
            // dd($isOf['is_offer']);
            // $this->isShowOp = $isOf['is_offer'];
        }
        $isOffer1 = session()->get('isOffer');
        if($isOffer1['is_offer'] == null) {
            $this->dispatchBrowserEvent('offer-product-Model');
        }

    }



    protected $rules = [
        'singleV' => 'required'
    ];
    protected $messages = [
        'singleV.required' => 'Veuillez sélectionner des produits !',
    ];

    public function render()
    {
    	$offerP = offerP::all();
        return view('livewire.offer', compact('offerP'));
    }

    public function getTotal()
    {
    	$NewSub = 0;
    	if(session('cart')){
            $qq = session('cart');
            foreach(session('cart') as $id => $details){
                $NewSub += $details['price'] * $details['quantity'];

                // $qq += $details['price'] * $details['quantity'];
            }
        }

        // dd($NewSub);
        $this->total = $NewSub;
    }

     public function addToCart()
    {
        // dd();
         $this->validate();
    	$isOffer = session()->get('isOffer');

    	$isOffer = ['is_offer' => 1];
    	$isOffer = session()->put('isOffer', $isOffer);

        $getPro = offerP::find($this->singleV);

        $def = 1000;

        	 $cart = session()->get('cart');
             $cart[$def] = [
                    "id" =>  $def,
                    "name" => $getPro->name,
                    "quantity" => 1,
                    "price" => 00,
                    "extraPrice" => 00,
                    "img" => $getPro->image,
                    "select" =>null,
                    "g_paid" =>null,
                    "is_show" => null,
                    "is_paid" => null,
                    "product_type" => null,
                    "is_offer" => 1,
                    "is_pro" => 1,
                    "discountable" => 0,
                ];
                // dd($cart);
                session()->put('cart', $cart);

               $this->emit('reloadPage');
                $this->alertForProduct();
                $this->dispatchBrowserEvent('hide-modal1');
                // $dd = url()->current();
                // // $dd = str_replace('/', '', $dd);
                // dd($dd);
                // if($dd == 'cart'){
                //     return redirect()->to('/cart');
                // }

    }

    public function notTake()
    {
    	$isOffer = session()->get('isOffer');

    	$isOffer = ['is_offer' => 1];
    	$isOffer = session()->put('isOffer', $isOffer);
         $this->dispatchBrowserEvent('hide-modal1');
    }

    public function alertForProduct()
    {
         $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Free Product Added Successfully!',
                // 'text' => 'It will list on users table soon.'
            ]);
    }
}
