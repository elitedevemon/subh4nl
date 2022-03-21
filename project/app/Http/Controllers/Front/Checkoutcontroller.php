<?php

namespace App\Http\Controllers\Front;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\setting;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\ExpressCheckout;
// use Torann\GeoIP\Facades\GeoIP;
use Session;
class Checkoutcontroller extends Controller
{

    public $total;
    private function getCheckoutData()
    {
        $cartId = auth()->user()->cartToken();
        $userCart = collect(session()->get($cartId, collect([])));
        return collect($userCart->get("items"))->map(function ($item) {
            return ["price" => $item["offer_price"], "qty" => $item["quantity"], "name" => $item["name"]];
        })->values()->toArray();
    }

    public function paymentWithPaypalStore(Request $request, Order $order)
    {
        $token = $request->get("token");
        $payerId = $request->get("PayerID");
        $provider = new ExpressCheckout();
        $response = $provider->getExpressCheckoutDetails($token);

        if (Arr::has(["SUCCESS", "SUCCESSWITHWARNING"], $response["ACK"])) {
            $payment_status = $provider->doExpressCheckoutPayment($this->getCheckoutData(), $token, $payerId);

        }

        dd("success");
    }

    public function paymentWithPaypalView(Order $order)
    {
        $cartId = auth()->user()->cartToken();
        $userCart = collect(session()->get($cartId, collect([])));

        $provider = new ExpressCheckout();
        $response = $provider->setExpressCheckout([
            "items" => $this->getCheckoutData(),
            "return_url" => route("payment.store.paypal", $order->id),
            "cancel_url" => route("payment.store.paypal", $order->id),
            "invoice_id" => Str::uuid()->toString(),
            "invoice_description" => "Order description",
            "total" => $userCart->get("pay_amount")
        ], false);

        dd($response);

        return redirect($response["paypal_link"]);
    }


    public function sayMyName(Order $order)
    {
        dd('hello Peter');
    }

    function checkout()
    {


        // return redirect()->to('https://pay.stripe.com/receipts/acct_1INz3BAAbBvvJ1Cb/ch_3JTVRDAAbBvvJ1Cb1w6gT7nQ/rcpt_K7kxEdHDhXk7Y89lPtPONedGAPCLtgO');

        $NewSub = 0;
        if(session('cart')){
            foreach(session('cart') as $id => $details){
                $NewSub += $details['price'] * $details['quantity'];
                // dd($NewSub);
            }

        }


        $this->total = $NewSub;


        // $cartId = auth()->user()->cartToken();
        // $userCart = collect(session()->get($cartId, collect([])));
        // return view('front.checkout', compact("userCart"));
        // $NewSub = 0;
        // if(session('cart')){
        //     foreach(session('cart') as $id => $details){
        //         $NewSub += $details['price'] * $details['quantity'];

        //     }

        // }


        if (session('orderPart') == null) {
            $orderPart = session()->get('orderPart');
            $orderPart = [
                            'discount' => 0,
                            'grand' => $this->total,
                            'total' => $this->total,
                            'shipping' => $this->total,
                            'orderType' => null,
                        ];
            session()->put('orderPart', $orderPart);
        }


        // $cusExists = Customer::where('user_id', auth()->user()->id)->exists();
        // if (!$cusExists) {

        //     $cus = Customer::create([
        //         'name' => auth()->user()->name,
        //         'user_id' => auth()->user()->id,
        //     ]);


        // }else{
            $cus = Customer::where('user_id', auth()->user()->id)->first();
        // }



        return view('front.checkout', compact('cus'));
    }


    public function saveOrder(Request $request)
    {
        // return  $request->all();
       $getOrder = session('orderPart');

        $this->validate($request,[
            'ship1' => 'required',
        ],[
            'ship1.required' => 'Attention ! Choisissez un mode de paiement',
        ]);

           if($request->ship1 == 'Carte_Bancaire_en_Iigne'){

             $this->validate($request,[
                'namde' => 'required',
                'card' => 'required',
                'cvc' => 'required',
                'month' => 'required',
                'year' => 'required',
            ],[
                'namde.required' => 'Vous devez doit entrer le nom',
                'card.required' => 'Vous devez saisir le numéro de carte',
                'cvc.required' => 'Vous devez doit entrer cvc',
                'month.required' => 'Vous devez entrer le mois',
                'year.required' => "Vous devez entrer l'année",
            ]);

            $setting = setting::find(1);
            

            $amount = (number_format($getOrder['grand'], 2, '.', '') * 100);
            Stripe::setApiKey($setting->stripe_sc);

                try {
                       $token = \Stripe\Token::create(
                                    array(
                                            "card" => array(
                                            "name" => $request->card,
                                            'number' => $request->card,
                                            'exp_month' => $request->month,
                                            'exp_year' => $request->year,
                                            'cvc' => $request->cvc,
                                        )
                                    )
                                );
                } catch(\Stripe\Exception\CardException $e) {

                $f = $e->getError()->message . '\n';
                  return redirect()->route('checkout.index')->with('status', $f);
                }

                $charge = Charge::create([
                    "amount" => $amount,
                    "currency" => "EUR",
                    "source" => $token,
                    "description" => "This payment",
                ]);

        }

        $cusExists = Customer::where('user_id', auth()->user()->id)->exists();
        if (!$cusExists) {

            $cus = Customer::create([
                'name' => auth()->user()->name,
                'user_id' => auth()->user()->id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'state' => $request->customer_city,
                'lat' => $request->customer_zip,
            ]);
        }else{
            $cus = Customer::where('user_id', auth()->user()->id)->first();
        }



        $randomNumber = random_int(1, 999);
        $randomNumber1 = random_int(0, 9);
        $inNumber = "IN-".$randomNumber.$randomNumber1;
        // $orderNumber = session()->get('orderNumber');
        // $orderNumber = $this->invoiceNum;

        if(session()->get('orderType')){

                $orderType = session()->get('orderType');

        }



        
        if ($getOrder['orderType'] == 'order') {
           $totalCart = $getOrder['total'];
        }else{
            $totalCart = $getOrder['total'];
        }
  
        $order =  Order::create([
            'user_id' => auth()->user()->id,
            'orderType' =>$getOrder['orderType'],
            'payment_method' => $request->ship1,
            'order_number' => $inNumber,
            'customer_phone' => $request->phone_number,
            'customer_name' => $request->name,
            'msg' => $request->msg,
            'customer_id' => $cus->id,
            'customer_address' => $request->address,
            'customer_city' => $request->customer_city,
            'customer_zip' => $request->customer_zip,
            'customer_lo' => 33, //$getOrder['lat']
            'customer_la' => 33, //$getOrder['lon']
            'shipping_cost' => $getOrder['shipping'],
            'discount' => $getOrder['discount'],
            'payment_status' => 1,
            'pay_amount' => $totalCart,
            'totalQty' => $getOrder['qty'],
            'time' => $request->time,
            'date' => $request->date,
        ]);

        // return back();
        // $data = [];
        // $data['id'] = $order->id;
        // $data['eid'] = $order['id'];

        // dd($data);

        // $orderList->tableNumber = 'dsf';


        if(session('cart')){
            foreach(session('cart') as $id => $details){
                // $json_skills = serialize($details['select']);
                // $array = $details['select'];
                // $names = Arr::pluck($array, [0]);
                // dd($names);
                $pro = \App\Models\Product::find($details['id']);
                $orderList = new OrderList();
                    $orderList->order_id = $order->id;
                    // $orderList->product_id = $details['id'];
                    $orderList->name = $details['name'];
                    $orderList->quantity = $details['quantity'];
                    $orderList->price = $details['price'];
                    $orderList->extraPrice = $details['extraPrice'];
                    $orderList->is_show = $details['is_show'];
                    $orderList->image = $details['img'];
                    $orderList->selectOption = $details['select'];
                    if (isset($pro->tax)) {
                        $orderList->tax = $pro->tax;
                    }

                    // if($details['is_show'] == null){
                    // }
                    // if(isset($details['is_paid']) == 1){
                    //     $orderList->g_paid = $details['g_paid'];
                    //     $orderList->is_paid = $details['is_paid'];
                    // }
                    $orderList->save();
                // $NewSub += $details['price'] * $details['quantity'];
            }


            if($request->ship1 === 'Carte_Bancaire_en_Iigne'){



        $order->txnid = $charge["balance_transaction"];
        $order->status = $charge["status"] == "succeeded" ? 1 : 0;
        $order->save();


        if (isset(auth()->user()->email)) {
               $details = [
                      'title' => 'Mail from RajMahal',
                      'body' => 'you have just received an order form '. auth()->user()->name . ' invoice number '.$inNumber,
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Restaurant Raj Mahal',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                  ];

                   \Mail::to(['info@restaurantrajmahal.fr'])->send(new \App\Mail\OrderMail($details));
                  // dd("Email is Sent.");

                Session::forget(['orderPart','cart','getVoucher']);
                return redirect()->route('myOrder')->with('status', 'votre commande effectuée avec succès');

        }else{


            if (isset(auth()->user()->email)) {
               $details = [
                      'title' => 'Mail from Jardin de Kashmir',
                      'body' => 'you have just received an order form'. auth()->user()->name . 'invoice number'.$inNumber,
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Restaurant Raj Mahal',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                  ];

        //dynamic email need ConFMail.php 

                   \Mail::to(['info@restaurantrajmahal.fr'])->send(new \App\Mail\OrderMail($details));
                  // dd("Email is Sent.");
           }
                // Session::flush();
                Session::forget(['orderPart','cart','getVoucher']);
                return redirect()->route('myOrder')->with('status', 'votre commande effectuée avec succès');
            }
            }
            
               if (isset(auth()->user()->email)) {
               $details = [
                      'title' => 'Mail from Restaurant Raj Mahal',
                      'body' => 'you have just received an order form'. auth()->user()->name . 'invoice number'.$inNumber,
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Restaurant Raj Mahal',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                  ];

        //dynamic email need ConFMail.php 

                   \Mail::to(['info@restaurantrajmahal.fr'])->send(new \App\Mail\OrderMail($details));
                  // dd("Email is Sent.");
           }
         
            Session::forget(['orderPart','cart','getVoucher']);
            return redirect()->route('myOrder')->with('status', 'votre commande effectuée avec succès');
            return redirect()->route('index');
            // Session::flush();

            //  session()->put('orderNumber', $orderNumber);


            // if($this->putValue == 'waiter'){
            //      return redirect()->to('/waiter-order');
            // }
            return redirect()->route('conform.order');


        }

        dd('hoice');
    }



    public function paymentWithStripeView(Order $order)
    {
        return view("front.payment.stripe", compact("order"));
    }

    public function paymentWithStripeStore(Request $request, Order $order)
    {

              $general = setting::find(1)->first();
              $sk = $general->stripe_sc;
        $data = $request->validate(
            [
                "stripeToken" => "required|string",
            ],
            [
            ]
        );

        	if($order->order_method == "pickUp"){

        	     $payTotal = $order->pay_amount;

        	}elseif($order->order_method == "deliveryPoint"){

        	     $payTotal = $order->pay_amount + $order->shipping_cost;
        	}

//         	if(is_int($num)){
// echo "hoice";
// }else if(is_float($num)){
// echo "huda";
// }

        // 	if(is_int($payTotal)){
        // 	    $amount = str_replace([',', '.'], ['', ''],$payTotal);
        // 	}elseif(is_float($payTotal)){
        // 	    $amountOld = str_replace([',', '.'], ['', ''],$payTotal);
        // 	    $amount = $amountOld / 10;
        // 	}

    //  return  $amount = str_replace([',', '.'], ['', ''],$payTotal);
    
    $amount = (number_format($payTotal, 2, '.', '') * 100);
    
    //   $amount = $payTotal * 100;
    //  return  $amount;
       
       // pk_test_51INz3BAAbBvvJ1CbMgJFM1Jr3o9L98hWTLi92GMdiMWmVebXaYXtJHkMIHKcwqGPKBlb42R9dCIRsF8jB9oKdq5a00KNiFfyCq

    // sk_test_51INz3BAAbBvvJ1CbK05lOv28m1wSehpcOw5OuubX0bZXO1SBnnJU1x19R5cwlwNRmzMzqqOllDPRYSzyokpj3ZYq00ZGenC6Qj

        Stripe::setApiKey('sk_test_51INz3BAAbBvvJ1CbK05lOv28m1wSehpcOw5OuubX0bZXO1SBnnJU1x19R5cwlwNRmzMzqqOllDPRYSzyokpj3ZYq00ZGenC6Qj');
        $charge = Charge::create([
            "amount" => $amount,
            "currency" => "EUR",
            "source" => $request->stripeToken,
            "description" => "This payment",
        ]);

        $order->txnid = $charge["balance_transaction"];
        $order->status = $charge["status"] == "succeeded" ? 1 : 0;
        $order->save();
/// receipt_url
        return redirect(route("payment.success"));
    }

    public function store(Request $request)
    {
        
        // return $request->all();
       $ip =  $_SERVER['REMOTE_ADDR'];
        $arr_ip = geoip()->getLocation($ip);

// dd($arr_ip->lat);
// dd($arr_ip->lon);
        // $cartId = auth()->user()->cartToken();
        // $userCart = session()->get($cartId, collect([]));
        // // session()->flash("coupon_added", $pay_amount);
        // dd($userCart);

        $data = $request->validate(
            [
                "customer_city" => "nullable|string",
                "customer_zip" => "nullable|integer",
                "customer_phone" => "required|string",
                "customer_name" => "required|string",
                "customer_email" => "nullable|email",
                "customer_address" => "",
                "customer_lo" => "nullable",
                "customer_la" => "nullable",
                // "shipping_cost" => "required|integer",
                "payment_method" => "required|string",
                "time" => "required",
                "date" => "required|date",
                // "totalQty" => "required|integer",
                "pay_amount" => "required",
            ],
            [
                "time.required" => "The hours field is required",
                "date.required" => "The day field is required",
                "shipping_cost.required" => "The shipping method field is required",
            ]
        );

        // store the order in the db
        $userId = auth()->id();
        $cartId = auth()->user()->cartToken();
        $userCart = session()->get($cartId, collect([]));
        $data["user_id"] = $userId;
        $data["payment_status"] = 0;
        $data["payment_status"] = 0;
        $data["order_method"] = $request->order_method;
        $data["shipping_cost"] = $request->shipping_cost;
        $data["customer_la"] = $arr_ip->lat;
        $data["customer_lo"] = $arr_ip->lon;
        $data["totalQty"] = 0;

        $orderProducts = collect($userCart->get("items"))
            ->map(function ($item) {
                $itemCollection = collect($item);
                $dataToReturn = [];

                if ($itemCollection->has("products")) {
                    $dataToReturn["set_menu_id"] = $itemCollection->get("id");
                    $dataToReturn["details"] = collect($itemCollection->get("products"))->implode(", ");
                    $dataToReturn["qty"] = $itemCollection->get("quantity");
                } else {
                    $dataToReturn["product_id"] = $itemCollection->get("id");
                    $dataToReturn["qty"] = $itemCollection->get("quantity");
                }

                return $dataToReturn;
            });

        $order = Order::create($data);
        $order->products()->createMany($orderProducts);

        if ($data["payment_method"] == "stripe") {
            return redirect(route("payment.index.stripe", $order->id));
        }

        if ($data["payment_method"] == "paypal") {
            return redirect(route("payment.index.paypal", $order->id));
        }

        return redirect()->route('payment.success');
    }

    public function success()
    {
        return view('front.payment.success');
    }
}
