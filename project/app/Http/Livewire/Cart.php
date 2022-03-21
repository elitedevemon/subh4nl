<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shipping;
use App\Models\setting;
class Cart extends Component
{
    public $total = 0;
	public $grandTotal = 0;
    public $increment;
    public $invoiceNum;
    public $discount = 0;
    public $tableNumber;
    public $takeTableNumber;
    public $orderPerson = 'Null';
	public $putValue;
    public $paymentType = 'Esepéces';
    public $tempOrderType;
    public $orderTypeCart;
    public $hri = false;
    public $getaName;
    public $shippingCost;
    public $qty;
    public $totalDistance;
    public $lat;
    public $lon;
    public $shippings;
    public $getDiscountD;
    public $orderSelect;
    public $shipPrice = 0;
    public $cartItems = [];
    public $getLat;
    public $cool;
    public $getLon;
    public $isValGeo;
    public $newGeo;
    public $finalGeo;
    public $alertSHow = 'hide';
    public $dammyTct;
    public $getOrder;
    public $address;
    public $customer_city;
    public $zip;
    public $isDeliver;
    public $postalCode;
    public $offerLimit;
    public $withoutOfferPrice;
    public $nn = 0;




	public function mount()
	{


        $this->getTotal();
        // $this->updatedZip();
        // $this->getKm();
        // $this->cartSubTotalUp();
         $randomNumber = random_int(1, 99);
        $randomNumber1 = random_int(0, 9);
        $inNumber = "IN-".$randomNumber.$randomNumber1;
        $this->invoiceNum = $inNumber;
        $orderPart = session('orderPart');
        $this->getOrder = session('orderPart');
        $ss = setting::find(1);

        $this->offerLimit = $ss->offer_limit;
        // $this->findSelect($orderPart['orderType'] = 'takeway');
        // $this->orderSelect = $orderPart['orderType'];
        // dd($orderPart['orderType']);

    }

    protected $listeners = [
                            'reloadPage' => '$refresh',
                            'getLat' => 'getLat',

                        ];
    // public function updategetLat($updateTitle)
    // {
    //     $this->getLat = $updateTitle;
    // } 
    // public function updategetLon($updateTitle)
    // {
    //     $this->getLon = $updateTitle;
    //     dd($this->getLon);
    // }

    public function getLat($value)
    {
       // dd($value);
        $this->updatedIsValGeo($value);
        // if ($value != null) {
        //     $this->hydrateIsValGeo($value);
        // }
    }

    public function updatedZip()
    {
        // dd($this->zip);
        $getOrder = session('orderPart');
        // dd();
        if ($getOrder['orderType'] == 'order') {
        // if ($this->tempOrderType == 'order') {

              $orderPart2 = session()->get('orderPart');

              $shipCost = Shipping::where('id', $this->zip)->first();

              // dd($shipCost);

              $this->postalCode = $shipCost->code;
              $cost = floatval($shipCost->cost);
              $this->shippingCost = $cost;
                // dd($getOrder['discount']);
                $orderPart2 = [
                    'discount' => 0,
                    'grand' => $getOrder['grand']+$cost,
                    'total' => $getOrder['total'],
                    'qty' => $getOrder['qty'],
                    'shipping' => $cost,
                    'orderType' => 'order',
                    ];
                    session()->put('orderPart', $orderPart2);

                $this->isDeliver = 1;


        }

    }



    public function updatedIsValGeo($value)
    {
        $this->newGeo = $value;
        // dd($value);
    }


    public function getOrderTypep($value)
    {

        $this->tempOrderType = $value;
        dd($value);
        // $this->cartSubTotalUp();
        $this->updatedTempOrderType();
    }


    public function render()
    {
        $this->cartItems = session('cart');
        return view('livewire.cart');
    }

    public function removeCart($id = null)
    {
            $cart = session()->get('cart');
            $def = $id;
            $def .= 1000;

            // offer product remove
            if (isset($cart[$def])) {
                // dd($cart[$def]);
                $cart2 = session()->get('cart');
                unset($cart2[$def]);
                session()->put('cart', $cart2);
            }
            // dd('dara');

        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            // session()->flash('success', 'Product removed successfully');
        }


        $this->emit('updateSideCartCount');

         $this->mount();
         $this->getTotal();

        if ( $this->offerLimit > $this->withoutOfferPrice) {
   
            $cart1 = session()->get('cart');
            if(isset($cart1[1000])) {
                unset($cart1[1000]);
                session()->put('cart', $cart1);
            }
            $isOffer = session()->get('isOffer');

            $isOffer =  ['is_offer' => 2];
            $isOffer = session()->put('isOffer', $isOffer);
        }


    }

    public function increament($value)
    {

        $value1 = substr($value, 0, 3);
        $getPro = \App\Models\Product::findOrFail($value1);
        $offer = session()->get('cart');
        $ss1 = setting::find(1);

        if($ss1->is_offer2 == 1){
            if ($getPro->is_pro == 2) {
                if(isset($offer[$value])){
                    $mainQty = $offer[$value]['quantity'] + 1;
                    if ($mainQty >= $getPro->sale_limit ) {

                         $def = $value;
                         $def .= 1000;

                        $sale = \App\Models\Sale::where('product_id', $offer[$value])->get();


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
                                    "pro_id" => $value,
                                ];
                             }
                            session()->put('cart', $cart);
                    }
                }
            }
        }


    	$cart = session()->get('cart');
    	if(isset($cart[$value])) {
            $cart[$value]['quantity']++;
            session()->put('cart', $cart);
        }

        $this->emit('updateSideCartCount');
        $this->mount();

        if($this->total > $this->offerLimit){
             if ($getPro->is_pro != 2) {
                    if ($this->withoutOfferPrice >= $this->offerLimit) {
                            $ss1 = setting::find(1);
                            if($ss1->is_offer1 == 1){
                                $this->emit('getAOffer');
                            }
                    }
                }
           $this->mount();
        }

    }
    public function decreament($value)
    {
    	$cart = session()->get('cart');

            $def = $value;
            $def .= 1000;

            // offer product remove
            if (isset($cart[$def])) {
                $cart2 = session()->get('cart');
                unset($cart[$def]);
                session()->put('cart', $cart2);
            }

    	if(isset($cart[$value])) {
            if ($cart[$value]['quantity'] > 1) {
                $cart[$value]['quantity']--;
                session()->put('cart', $cart);
            }
        }

        $this->emit('updateSideCartCount');
        $this->mount();
        if ( $this->offerLimit > $this->withoutOfferPrice) {

            // dd($this->withoutOfferPrice);
            $cart1 = session()->get('cart');
            if(isset($cart1[1000])) {
                unset($cart1[1000]);
                session()->put('cart', $cart1);
            }
            $isOffer = session()->get('isOffer');

            $isOffer =  ['is_offer' => 2];
            $isOffer = session()->put('isOffer', $isOffer);
        }
    }


    public function getTotal()
    {
        $NewSub = 0;
        $NewSub1 = 0;
        $offerPrice = 0;
    	$qq = 0;
    	if(session('cart')){
            $qq = session('cart');
            foreach(session('cart') as $id => $details){
                $NewSub += $details['price'] * $details['quantity'];
                $NewSub1 += $details['quantity'];
                if ($details['is_pro'] == 1) {
                    $offerPrice += $details['price'] * $details['quantity'];
                }
                // $qq += $details['price'] * $details['quantity'];
            }


        }
          if ($this->offerLimit > $NewSub) {
            $isOffer = session()->get('isOffer');
            $isOffer = ['is_offer' => 2];
            $isOffer = session()->put('isOffer', $isOffer);
        }
        $getVoucher = session()->get('getVoucher');
        if (session()->get('getVoucher') != null){
            $this->nn = $getVoucher['am'];
            $nn1 = $NewSub - $this->nn;
        }else{
            $nn1 = $NewSub - $this->nn;
        }

        // dd($NewSub);
        $this->total = $nn1;
        $this->qty = $NewSub1;
        $this->withoutOfferPrice = $offerPrice;


        // if(session()->get('orderType') == 'takeAway' || session()->get('waiterOrderType') == 'takeAway'){

        //     $discount = Setting::find(1);

        //     $this->discount = $NewSub * $discount->dis / 100;
        //     $getTotal = $NewSub - $this->discount;
        //     $this->total = $getTotal;

        // }elseif(session()->get('orderType') == 'order' || session()->get('waiterOrderType') == 'order'){

        //     $this->total = $NewSub;

        // }
        // $this->mount();

    }


   




    public function updatedTempOrderType()
    {


        $this->getOrder = session('orderPart');


        // $this->updatedZip();
        $this->hri = true;
        $this->getTotal();
        $this->cartSubTotalUp();
    }

    public function findSelect($data)
    {
        $st = setting::find(1);
       $this->getDiscountD = $st->discount;

        $orderPart = session()->get('orderPart');


        $this->shippingCost = $this->shipPrice;

        if($data == 'takeway') {
            // $discount = Setting::find(1);
            $this->discount = $this->total * $this->getDiscountD / 100;
            $getTotal = $this->total - $this->discount;
            $this->grandTotal = $getTotal;

            $orderPart = [
                'discount' => $this->discount,
                'grand' => $this->grandTotal,
                'total' => $this->total,
                'qty' => $this->qty,
                'shipping' => $this->shippingCost,
                'orderType' => 'takeway',
                'lat' => $this->lat,
                'lon' => $this->lon,
            ];


        }elseif ($data == 'order') {
             $totalGr = $this->total + $this->shippingCost;
             $this->grandTotal = $totalGr;

             $orderPart = [
                'discount' => 0,
                'grand' => $this->grandTotal,
                'total' => $this->total,
                'qty' => $this->qty,
                'shipping' => $this->shippingCost,
                'orderType' => 'order',
                'lat' => $this->lat,
                'lon' => $this->lon,
            ];



        }
        session()->put('orderPart', $orderPart);

    }


    public function cartSubTotalUp()
    {


        // dd($this->tempOrderType);

        $st = setting::find(1);
       $this->getDiscountD = $st->discount;

        $this->orderTypeCart = $this->tempOrderType;
        $orderPart = session()->get('orderPart');

        // $this->shippingCost = $this->shipPrice;

        if($this->tempOrderType == 'takeway') {

            $withDiscount = 0;
            $withOutDiscount = 0;
            $qq = session('cart');
            foreach(session('cart') as $id => $details){
                if ($details['discountable'] == 1) {
                    $withOutDiscount =+ $details['price'] * $details['quantity'];
                }
                if ($details['discountable'] == 0) {
                    $withDiscount += $details['price'] * $details['quantity'];
                }

            }
            // dd($withDiscount);

            // $discount = Setting::find(1);
            $this->discount = $withDiscount * $this->getDiscountD / 100;
            $getTotal = $withDiscount - $this->discount;
            $newT = $getTotal + $withOutDiscount;
            $this->grandTotal = $getTotal;

            // dd($this->discount);
            $orderPart = [
                'discount' => $this->discount,
                'grand' => $this->grandTotal,
                'total' => $this->total,
                'qty' => $this->qty,
                'shipping' => $this->shippingCost,
                'orderType' => 'takeway',
                'lat' => 33,
                'lon' => 33,
            ];

            // dd($orderPart);


        }elseif($this->tempOrderType == 'order') {
            // dd($this->tempOrderType == 'order');
             $totalGr = $this->total + $this->shippingCost;
             $this->grandTotal = $totalGr;

             $orderPart = [
                'discount' => 0,
                'grand' => $this->grandTotal,
                'total' => $this->total,
                'qty' => $this->qty,
                'shipping' => null,
                'orderType' => 'order',
            ];


        }
            // dd($orderPart);
        session()->put('orderPart', $orderPart);
        // $this->mount();
    }




    public function getDiscount()
    {
        $st = setting::find(1);
       $this->getDiscountD = $st->discount;
        $orderPart = session()->get('orderPart');

        $this->shippingCost = $this->shipPrice;

        // dd($st);

        if($this->tempOrderType == 'takeway') {

            $withDiscount = 0;
            $withOutDiscount = 0;
            $qq = session('cart');
            foreach(session('cart') as $id => $details){
                if ($details['discountable'] == 1) {
                    $withOutDiscount =+ $details['price'] * $details['quantity'];
                }
                if ($details['discountable'] == 0) {
                    $withDiscount += $details['price'] * $details['quantity'];
                }

            }
            // dd($withDiscount);

            // $discount = Setting::find(1);
            $this->discount = $withDiscount * $this->getDiscountD / 100;
            $getTotal = $withDiscount - $this->discount;
            $newT = $getTotal + $withOutDiscount;
            $this->grandTotal = $getTotal;

            $orderPart = [
                'discount' => $this->discount,
                'grand' => $this->grandTotal,
                'total' => $this->total,
                'qty' => $this->qty,
                'shipping' => $this->shippingCost,
                'orderType' => 'takeway',
                'lat' => $this->lat,
                'lon' => $this->lon,
            ];


        }
            session()->put('orderPart', $orderPart);

    }
     protected $rules = [
        'address' => 'required',
        'customer_city' => 'required',
        'zip' => 'required',
    ];
    protected $messages = [
        'address.required' => "L'adresse ne peut pas être laissée vide",
        'customer_city.required' => 'la ville ne peut pas être laissée vide',
        'zip.required' => 'le code postal ne peut pas être laissé vide',
    ];


    public function getDataFOrmCustomer()
    {
         $this->validate();
        $cusTro = session()->get('cusTro');
              $cusTro = [
                    'address' => $this->address,
                    'city' => $this->customer_city,
                    'customer_zip' => $this->postalCode,
                ];
            session()->put('cusTro', $cusTro);
            // return redirect()->route('checkout');
            return redirect()->to('/checkout');
    }




}
