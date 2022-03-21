<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProTitle;
use App\Models\setting;
use App\Models\ProductOption as proOption;
class ProductOption extends Component
{
	public $product_id;
	public $proAttr1;
	public $proAttr2;
    public $proAttr3;
    public $newValue;
	public $getSingleID;

    public $mulpleS = [];
    public $singleV =[];
    public $mulplePaid = [];
    public $mulplePaid1 = [];
    public $dammy = [];
    public $isMsg;

    public $getTo = [];

    public $total = 0;
    public $getSingleCount;

	protected $listeners = ['getModelDataOp' => 'getModelDataOp'];

	public function mount()
	{
	}

	public function getModelDataOp($id)
	{
		$this->product_id = $id;

		$product = Product::find($id);

        $this->newValue = $product;

        $ccCOunt = 0;

            foreach($this->newValue->product_option as $ss){
                $this->getSingleID = \App\Models\ProTitle::where('id', $ss)
                                ->where('is_type', 'single_selection')
                                ->get();
                                if (count($this->getSingleID) > 0) {
                                    $ccCOunt++;
                                }

            }
            $this->getSingleCount = $ccCOunt;
            // dd($this->getSingleCount);
            //                     ->where('is_type', 'single_selection')
            //                     ->count();

            // dd($this->getSingleID);

    	// $getProAttrMs = ProductAttr::where('product_id', $id)
    	// 						  ->where('is_type', 'multiple_selection')
    	// 						  ->where('status', 1)
    	// 						  ->get();
    	// $this->proAttr1 = $getProAttrMs;

    	// $getProAttrSs = ProductAttr::where('product_id', $id)
    	// 						  ->where('is_type', 'single_selection')
    	// 						  ->where('status', 1)
    	// 						  ->get();
    	//  $this->proAttr2 = $getProAttrSs;

    	// $getProAttrPms = ProductAttr::where('product_id', $id)
    	// 						  ->where('is_type', 'paid_multiple_selection')
    	// 						  ->where('status', 1)
    	// 						  ->get();
    	// $this->proAttr3 = $getProAttrPms;

        $this->dispatchBrowserEvent('show-modal');

	}

    protected $rules = [
            // 'dammy.*' => 'required|array',
            // 'dammy.*' => 'required',
            'singleV' => 'required|array|unique:product_options', 
            'singleV' => 'required'
        ];
        protected $messages = [
            'singleV.required' => 'Veuillez sélectionner des produits !',
        ];

//     public function getDataF($v)
//     {

// dd($this->mulplePaid);
//         $getOptios = proOption::where('id', $v)->first();
//         if (array_search($getOptios->name, $this->mulplePaid)) {
//             dd('puran');
//            unset($this->mulplePaid[$key]);
//            // $this->mount();
//         }else{
//             dd('notun');
//             array_push($this->mulplePaid, $getOptios->name);
//         $this->mount();
//         }

//     }
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
     public function addToCartOption()
    {
        // dd('opton');
         // $this->isMsg = 'Veuillez sélectionner des produits !';
       

        $cc = count($this->singleV);

       // dd(count($this->getSingleCount));


        if (count($this->getSingleID) > 0) {
            if($this->getSingleCount > $cc){
               $this->alertForSelect();
            }else{
               $this->executiveCart();
            }
        }else{
               $this->executiveCart();
            
        }


    }

    public function executiveCart()
    {

        $NewSub = 0;
        $getPro =Product::find($this->product_id);


        if ($getPro->is_promo == 1) {
                $price = $getPro->offer_price;
        }else{
            $price = $getPro->regular_price;
        }


        if($this->mulplePaid){


            foreach($this->mulplePaid  as $v){
                if ($v == true) {
                   $getOptios = proOption::where('name', $v)->sum('price');
                        // $NewSub += $getOptios->price;
                        $neT = floatval($getOptios);
                        $NewSub += $neT;
                }
                    }
                    // dd(gettype($neT));
        $extraPrice = $NewSub + $price;
        // $extraP = $NewSub;

         }else{
            $extraPrice = $price;

         }


      




         $cart = session()->get('cart');

        $randomNumber1 = random_int(0, 9);

          if(isset($cart[$this->product_id])) {

            $allOption1 = array_merge($this->mulpleS,$this->singleV,$this->mulplePaid);

            $cart[$this->product_id.$randomNumber1] = [
                    "id" => $getPro->id,
                    "name" => $getPro->name,
                    "quantity" => 1,
                    "price" => $extraPrice,
                    "extraPrice" => $NewSub,
                    "img" => $getPro->image,
                    "select" =>$allOption1,
                    "g_paid" =>$this->mulplePaid,
                    "is_show" => 2,
                    "is_paid" => 1,
                    "is_offer" => null,
                    "is_pro" => $getPro->is_pro,
                    "product_type" => $getPro->product_type,
                    "discountable" => 0,
                ];
                // dd($cart);
                session()->put('cart', $cart);
                $this->emit('updateCartCount');
                $this->getWithoutOfferPrice();
                if ($this->withoutOfferPrice >= $this->offerLimit) {
                   $ss1 = setting::find(1);
                            if($ss1->is_offer1 == 1){
                                $this->emit('getAOffer');
                            }
                }
                $this->emit('updateSideCartCount');
                $this->resetModel();
                $this->alertForProduct();
                 $this->dispatchBrowserEvent('hide-modal');
          }else{
          $allOption = array_merge($this->mulpleS,$this->singleV,$this->mulplePaid);
                
                 $cart[$this->product_id] = [
                    "id" => $getPro->id,
                    "name" => $getPro->name,
                    "quantity" => 1,
                    "price" => $extraPrice,
                    "extraPrice" => $NewSub,
                    "img" => $getPro->image,
                    "select" =>$allOption,
                    "g_paid" =>$this->mulplePaid,
                    "is_show" => 2,
                    "is_paid" => 1,
                    "is_offer" => null,
                    "is_pro" => $getPro->is_pro,
                    "product_type" => $getPro->product_type,
                    "discountable" => intval($getPro->discountable),
                ];
                // dd($cart);
                session()->put('cart', $cart);
                $this->emit('updateCartCount');
                $this->getWithoutOfferPrice();
                if ($this->withoutOfferPrice >= $this->offerLimit) {
                    $ss1 = setting::find(1);
                            if($ss1->is_offer1 == 1){
                                $this->emit('getAOffer');
                            }
                }
                $this->emit('updateSideCartCount');
                $this->resetModel();
                $this->alertForProduct();
                 $this->dispatchBrowserEvent('hide-modal');
          }
    }

    public function alertForProduct()
    {
         $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => 'Product Added Successfully!',
                // 'text' => 'It will list on users table soon.'
            ]);
    }
    public function alertForSelect()
    {
         $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'vous devez prendre tous les articles simples!',
                // 'text' => 'It will list on users table soon.'
            ]);
    }

public function resetModel()
{
     $this->mulpleS = [];
     $this->singleV =[];
     $this->mulplePaid = [];
     $this->mulplePaid1 = [];
}

    public function render()
    {
        return view('livewire.product-option');
    }
}
