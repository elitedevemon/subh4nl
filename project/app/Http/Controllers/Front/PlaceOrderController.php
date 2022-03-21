<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderList;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\ExpressCheckout;

class PlaceOrderController extends Controller
{
    public function saveOrder(Request $request)
    {

        // return $request->all();

        $randomNumber = random_int(1, 999);
        $randomNumber1 = random_int(0, 9);
        $inNumber = "IN-".$randomNumber.$randomNumber1;
        // $orderNumber = session()->get('orderNumber');
        // $orderNumber = $this->invoiceNum;

        if(session()->get('orderType')){

                $orderType = session()->get('orderType');

        }


        $getOrder = session('orderPart');

        $order =  Order::insertGetId([
            'user_id' => auth()->user()->id,
            'orderType' =>$getOrder['orderType'],
            'payment_method' => 'df',
            'order_number' => $inNumber,
            'customer_phone' => auth()->user()->phone_number,
            'customer_name' => $request->name,
            'customer_address' => $request->address,
            'customer_lo' => $getOrder['lon'], //$getOrder['lat']
            'customer_la' => $getOrder['lat'], //$getOrder['lon']
            'shipping_cost' => $getOrder['shipping'],
            'discount' => $getOrder['discount'],
            'payment_status' => 1,
            'pay_amount' => $getOrder['grand'],
            'totalQty' => $getOrder['qty'],
            'time' => $inNumber,
            'date' => $inNumber,
        ]);

        // return back();

        // dd($order);

        // $orderList->tableNumber = 'dsf';
  

        if(session('cart')){
            foreach(session('cart') as $id => $details){
                // $json_skills = serialize($details['select']);
                // $array = $details['select'];
                // $names = Arr::pluck($array, [0]);
                // dd($names);
                $orderList = new OrderList();
                    $orderList->order_id = $order;
                    $orderList->product_id = $details['id'];
                    $orderList->name = $details['name'];
                    $orderList->quantity = $details['quantity'];
                    $orderList->price = $details['price'];
                    $orderList->extraPrice = $details['extraPrice'];
                    $orderList->is_show = $details['is_show'];
                    $orderList->image = $details['img'];

                    // if($details['is_show'] == null){
                    //     $orderList->selectOption = $details['select'];
                    // }
                    // if(isset($details['is_paid']) == 1){
                    //     $orderList->g_paid = $details['g_paid'];
                    //     $orderList->is_paid = $details['is_paid'];
                    // }
                    $orderList->save();
                // $NewSub += $details['price'] * $details['quantity'];
            }

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
}
