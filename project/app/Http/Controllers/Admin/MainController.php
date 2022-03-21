<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\catren;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderList;
use App\Models\Admin;
use App\Models\setting;
use App\Models\Offer;
use App\Models\Schedule;
use App\Models\Shipping;
use App\Models\Point;
use App\Models\PointList;

use Carbon\Carbon;
use DB;
use Image;
class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // return view('admin.nn');
         $currentMonth = date('M');
        $currentDate = date('D');
        $currentYear = date('Y');
         $yesterday = Carbon::yesterday()->toDateString();
        
        $data = [];
        
      $todayDate = Carbon::now()->toDateString();
      $data['todayOrderCount'] =order::where('created_at',  $todayDate)->count();
      $data['todaySell'] =order::where('created_at',  $todayDate)->sum('pay_amount');
     $data['yesterdaySell'] = order::where('created_at',  $yesterday)->sum('pay_amount');
     $data['monthSell'] =order::where('created_at',  $currentMonth)->sum('pay_amount');
        
        

        
        
        return view('admin.dashboard', compact('data'));
    }   

     public function paymentInfo(Request $request)
    {
        $setting = setting::findOrFail(1);
        return view('admin.paymentInfo', compact('setting'));
    } 
      public function paymentSave(Request $request)
    {
        $setting = setting::findOrFail(1);
            $setting->is_paypal = $request->is_paypal;
            $setting->is_stripe = $request->is_stripe;
            $setting->is_cash = $request->is_cash;
            $setting->is_ticket = $request->is_ticket;
            $setting->is_cb = $request->is_cb;
            $setting->save();
       
        return back()->with('status','Payment Methods Updated');
    } 

    public function offerIdex()
    {
        $offer = Offer::orderBy('id', 'DESC')->get();
        return view('admin.offer', compact('offer'));
    }

    public function offerSave(Request $request)
    {
        $offer = new Offer();
        $offer->name = $request->name;
        if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(600,200)->save('storage/upload/product/'.$imageName);

          $offer->image = $imageName;

        }else {
            $offer->image = "default.png";
        }
        $offer->save();

        return back();
    }

    public function offerDelete($id)
    {
        Offer::find($id)->delete();

        // return back();
    }


    //report 

    public function reportIndex()
    {
        // return view('admin.report.showR');
        return view('admin.report.index');
    }
     public function reportMonth(Request $request)
    {
        // return $request->all();
        $g_month = $request->month;

        $currentYear = date('Y');


 // return        $getdaySellsMethod = DB::table('orders')
 //                                ->where('is_comp', 1)
 //                                ->where('pageView', 1)
 //                                ->whereMonth('created_at', '=', $g_month)
 //                                ->select([
 //                                        DB::raw("orders.payment_method as customerName"),
 //                                        // DB::raw("DATE_FORMAT(created_at, '%m') month"),
 //                                        DB::raw("MONTHNAME(created_at) as month"),
 //                                        // DB::raw("DATE_FORMAT(created_at, '%H:%i:00') orderTime"),
 //                                        DB::raw('DATE(created_at) as dates'),
 //                                        DB::raw("SUM(pay_amount) total_sales"),
 //                                        DB::raw("COUNT(id) total_c"),
 //                                     ])
 //                                 ->groupBy('customerName')
 //                                 ->groupBy('month')
 //                                 ->groupBy('dates')
 //                                 ->get();



          $getdaySellsTotal = DB::table('orders')->where('is_comp', 1)
                                ->where('pageView', 1)->whereMonth('created_at', '=', $g_month)->whereYear('created_at', '=', $currentYear)
                 ->select([
                        DB::raw("MONTHNAME(created_at) as month"),
                        DB::raw("SUM(pay_amount) total_sales"),
                        DB::raw("COUNT(id) total_c"),
                 ])
                 // ->groupBy('sellDate')
                 ->groupBy('month')->get();


            $getdaySellsMethod = DB::table('orders')
                                ->where('is_comp', 1)
                                ->where('pageView', 1)
                                ->whereMonth('created_at', '=', $g_month)
                                ->whereYear('created_at', '=', $currentYear)
                                ->select([
                                        DB::raw("orders.payment_method as customerName"),
                                        DB::raw("SUM(pay_amount) total_sales"),
                                        DB::raw("MONTHNAME(created_at) as month"),
                                        // DB::raw('DATE(created_at) as dates'),
                                        DB::raw("COUNT(id) total_c"),
                                     ])
                                 ->groupBy('customerName')
                                 // ->groupBy('orderTime')
                                 ->groupBy('month')
                                 // ->groupBy('dates')
                                 ->get();

return view('admin.report.showR', compact('getdaySellsMethod','getdaySellsTotal','g_month'));





        // $getdaySellsMethod = DB::table('orders')
        //                         ->where('is_comp', 1)
        //                         ->where('pageView', 1)
        //                         ->orWhere('payment_method','Carte_Bancaire_en_Iigne')
        //                         ->orWhere('payment_method','Espèces')
        //                         ->orWhere('payment_method','ticket_restrurant')
        //                         ->orWhere('payment_method','Carte_Bancaire_en_Livraison')
        //                         ->select([
        //                                 DB::raw("orders.payment_method as customerName"),
        //                                 // DB::raw("DATE_FORMAT(created_at, '%m') month"),
        //                                 // DB::raw("DATE_FORMAT(created_at, '%H:%i:00') orderTime"),
        //                                 DB::raw("SUM(pay_amount) total_sales"),
        //                                 DB::raw("COUNT(id) total_c"),
        //                              ])
        //                          ->groupBy('customerName')
        //                          ->get();


 // $getdaySellsMethod = DB::table('orders')->where('is_comp', 1)->where('pageView', 1)
 //                  ->select([
 //                        DB::raw("orders.customer_name as customerName"),
 //                        DB::raw("orders.order_method as order_method"),
 //                        DB::raw("DATE_FORMAT(created_at, '%H:%i:00') orderTime"),
 //                        // DB::raw("DATE_FORMAT(created_at, '%m') month"),
 //                        DB::raw("MONTHNAME(created_at) as month"),
 //                            DB::raw("SUM(pay_amount) total_sales"),
 //                     ])
 //                 ->groupBy('customerName')->groupBy('month')->groupBy('order_method')->groupBy('orderTime')->get();




// Carte_Bancaire_en_Iigne
// Espèces
// ticket_restrurant
// Carte_Bancaire_en_Livraison






        // return view('admin.report.month',compact('getMonthSellsMethod','paymentMethod','moth','getdaySellsTotal'));
        return view('admin.report.details', compact('data','getdaySellsMethod'));
        // return view('admin.report.showR', compact('data','getdaySellsMethod'));
    }


public function reportday(Request $request)
{
    $data = [];
     $data['to'] = $request->to;
    $data['from'] = $request->from;
    // $date = '2021-10-21';



    $getdaySellsTotal= \DB::table('orders')
                            ->whereBetween('date', [$data['to'], $data['from']])
                            ->selectRaw('count(*) as order_count, payment_method')
                            ->selectRaw('SUM(pay_amount) as sum, payment_method')
                            ->groupBy('payment_method')
                            ->get();



        //         $getdaySellsMethod = DB::table('orders')
        //                         ->where('is_comp', 1)
        //                         ->where('pageView', 1)
        //                         ->whereDate('created_at', '=', $date)
        //                         ->select([
        //                                 DB::raw("orders.payment_method as customerName"),
        //                                 DB::raw("SUM(pay_amount) total_sales"),
        //                                 DB::raw('DATE(created_at) as dates'),
        //                                 DB::raw("COUNT(id) total_c"),
        //                              ])
        //                          ->groupBy('customerName')
        //                          // ->groupBy('orderTime')
        //                          ->groupBy('dates')
        //                          // ->groupBy('dd')
        //                          ->get();
        // $getdaySellsTotal = DB::table('orders')
        //                         ->where('is_comp', 1)
        //                         ->where('pageView', 1)
        //                         ->whereDate('created_at', '=', $date)
        //                         ->select([
        //                                 DB::raw("SUM(pay_amount) total_sales"),
        //                                 DB::raw('DATE(created_at) as dates'),
        //                                 DB::raw("COUNT(id) total_c"),
        //                              ])
        //                          // ->groupBy('customerName')
        //                          // ->groupBy('orderTime')
        //                          ->groupBy('dates')
        //                          // ->groupBy('dd')
        //                          ->get();

        return view('admin.report.showR', compact('getdaySellsTotal','data'));


     // return       $getdaySellsMethod = DB::table('orders')->where('is_comp', 1)
     //                         ->where('pageView', 1)->whereDate('created_at', '=', '2021-09-16')
     //              ->select([
     //                    DB::raw("orders.payment_method as customerName"),
     //                    DB::raw("orders.order_method as order_method"),
     //                    DB::raw("DATE_FORMAT(created_at, '%H:%i:00') orderTime"),
     //                    DB::raw("DATE(created_at) as stat_day"),

     //                    // DB::raw("DATE_FORMAT(created_at, '%m') month"),
     //                    DB::raw("MONTHNAME(created_at) as month"),
     //                        DB::raw("SUM(pay_amount) total_sales"),
     //                 ])
     //             ->groupBy('customerName')->groupBy('month')->groupBy('order_method')->groupBy('orderTime')->groupBy('stat_day')->get();

   return view('admin.report.day',compact('getdaySellsMethod','paymentMethod','date','getdaySellsTotal'));

}


public function reportDetails($to, $from, $pMethods)
{
      $getdaySellsTotal= \DB::table('orders')
                            ->where('payment_method', $pMethods)
                            ->whereBetween('date', [$to,$from])
                            // ->selectRaw('count(*) as order_count, payment_method')
                            // ->selectRaw('SUM(pay_amount) as sum, payment_method')
                            // ->groupBy('payment_method')
                            ->get();
return view('admin.report.details', compact('getdaySellsTotal'));
}


public function reportSHowDetails($value,$date)
{
        $data['d1'] = DB::table('orders')
                             ->where('payment_method',$value)
                             ->where('is_comp', 1)
                             ->where('pageView', 1)
                             ->whereDate('created_at', '=', $date)
                             ->get();
return view('admin.report.details', compact('data'));
}

public function reportSHowDetailsMonth($value,$date)
{
    $currentYear = date('Y');
    $data['d1'] = DB::table('orders')
                                ->where('is_comp', 1)
                                ->where('pageView', 1)
                                ->where('payment_method',$value)
                                ->whereMonth('created_at', '=', $date)
                                ->whereYear('created_at', '=', $currentYear)
                                ->select([
                                        DB::raw("SUM(pay_amount) total_sales"),
                                        DB::raw("MONTHNAME(created_at) as month"),
                                        DB::raw('DATE(created_at) as dates'),
                                        DB::raw("COUNT(id) total_c"),
                                     ])
                                 // ->groupBy('orderTime')
                                 ->groupBy('month')
                                 ->groupBy('dates')
                                 ->get();
    return view('admin.report.reportSHowDetailsMonth', compact('data'));
}


public function reportYear(Request $request)
{
        $paymentMethod = $request->payment_method;
        $currentYear = $request->year;
          $getdaySellsTotal = Order::where('is_show', 1)->where('payment_method', $paymentMethod)->whereYear('created_at', '=', $currentYear)->sum('pay_amount');

            $getYearSellsMethod = Order::where('is_show', 1)->where('payment_method', $paymentMethod)->whereYear('created_at', '=', $currentYear)
                 ->select([
                        DB::raw("DATE_FORMAT(created_at, '%Y') year"),
                        // DB::raw("DATE_FORMAT(created_at, '%m') month"),
                        DB::raw("MONTHNAME(created_at) as month"),
                        DB::raw("SUM(pay_amount) total_sales"),
            ])->groupBy('year')->groupBy('month')->get();

                 return view('admin.report.year',compact('getYearSellsMethod','paymentMethod','currentYear','getdaySellsTotal'));

}


    //shipping 

    public function shippingIndex()
    {
        $shipping = Shipping::all();
        return view('admin.shipping', compact('shipping'));
    }  

    public function shippingSave(Request $request)
    {
        $shipping = Shipping::create($request->all());
        return back()->with('status','Shipping Cost Add Successfully');
    } 

    public function shippingDelete($id)
    {
        $shipping = Shipping::find($id);
        $shipping->delete();

   
    }
    public function shippingShow($id)
    {
       $shipping = Shipping::where('id', $id)->first();
        return view('admin.shipEdit', compact('shipping'));
    }

    public function shippingEdit(Request $request)
    {
        $id = $request->id;
        $shipping = Shipping::where('id',$id)->update([
            'km' => $request->km,
            'code' => $request->code,
            'status' => 1,
            'cost' => $request->cost,
        ]);
        
        return redirect()->route('shippingIndex');

    }

    public function shippingStatus(Request $request) 
    {
        $id = $request->reserID;
        $st = $request->status;

        Shipping::where('id', $id)->update([
            'status' => $st
        ]);

        return back();

    }

 

    ///order

    public function orderIndex(){
           $order = Order::where('pageView', 1)
                         ->where('is_comp', 1)
                         ->orderBy('id', 'desc')
                         ->get();
        return view('admin.order.index', compact('order'));
    }
    public function orderView($id){

        // $reservation = Order::where('id', $id)->update([
        //     'pageView' => 1
        //  ]);

        $getOrder = Order::find($id);

        return view('admin.order.create',compact('getOrder'));
    }
     public function orderGetNew(){

        $body = 'Carte_Bancaire_en_Iigne';
        $order = Order::orderBy('id', 'desc')
                        ->where('is_comp', 0)
                         ->with('orderlist')
                         // // if (where('payment_method', '')) {
                         // //        $query->whereNotNull('txnid');
                         // //    };
                         //    ->orWhere(function ($query) use($body) {
                         //        $query->orWhere('payment_method',$body)
                         //              ->whereNotNull('txnid');
                         //     })
                         ->get();
        return view('admin.order.order', compact('order'));
    }

    public function orderDelete($id)
    {
       $reservation = Order::where('id', $id)->delete();

        return back();
    }

    public function orderAccept($id)
    {
        $reservation = Order::where('id', $id)->update([
            'pageView' => 1
         ]);
           $usedr = Order::where('id', $id)->first();
           // return $usedr->user->email;
           if (isset($usedr->user->email)) {
               $details = [
                      'title' => 'Mail from Restaurant Raj Mahal',
                      'body' => 'votre commande a été acceptée. Nous vous contacterons bientôt',
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Restaurant Raj Mahal',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                      'attc' => 'storage/upload/banner/',
                  ];

        //dynamic email need ConFMail.php

                   \Mail::to([$usedr->user->email])->send(new \App\Mail\ConFMail($details));
                  // dd("Email is Sent.");
                  return back();
           }
        return back();
    }
    public function orderComplate($id)
    {
        $reservation = Order::where('id', $id)->update([
            'is_comp' => 1
         ]);

        return back();
    }


    public function getOrderTone(Request $request)
    {
        return $order = Order::where('payment_method','Carte_Bancaire_en_Iigne')
                                 ->whereNotNull('txnid')
                                 ->where('pageView', 0)
                                 ->orWhere('payment_method','Espèces')
                                 ->where('pageView', 0)
                                 ->orWhere('payment_method','ticket_restrurant')
                                 ->where('pageView', 0)
                                 ->orWhere('payment_method','Carte_Bancaire_en_Livraison')
                                 ->where('pageView', 0)
                                 ->get();
                                 // return $order = Order::where('payment_method','stripe')
                                 // ->whereNotNull('txnid')
                                 // ->where('pageView', 0)
                                 // ->orWhere('payment_method','cash')
                                 // ->where('pageView', 0)
                                 // ->orWhere('payment_method','ticket_restrurant')
                                 // ->where('pageView', 0)
                                 // ->orWhere('payment_method','payment_with_cb')
                                 // ->where('pageView', 0)
                                 // ->get();
                                 
    }

     public function OrderpaymentStatus(Request $request)
    {
         $order = Order::where('id', $request->reserID)->update([
            'payment_status' => $request->status
        ]);
        return back()->with('status','Payment Status has been Change');
    }

    //print

    public function orderPrint($id){
           $getOrder = Order::find($id);
        return view('admin.order.print', compact('getOrder'));
    }


///reservation

     public function reservation()
    {   
        $reservation = Reservation::latest()->get();
        return view('admin.reservation', compact('reservation'));
    } 
    public function reservationshow($id)
    {   
        return $reservation = Reservation::find($id);
        // return view('admin.reservation', compact('reservation'));
    }
    public function reservationStatus(Request $request)
    {   
        // return $request->all();
        $reservationID = $request->reserID;
        $status = $request->status;
         $reservation = Reservation::where('id', $reservationID)->update([
            'status' => $status
         ]);
         $getEMail = Reservation::where('id', $reservationID)->first();

         if ($getEMail->status == 1) {
             $details = [
                      'title' => 'Mail from Restaurant Raj Mahal',
                      'body' => 'votre réservation a été acceptée.',
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Restaurant Raj Mahal',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                  ];
         }elseif ($getEMail->status == 2) {
             $details = [
                      'title' => 'Mail from Restaurant Raj Mahal',
                      'body' => 'votre réservation a été rejetée.',
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Restaurant Raj Mahal',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                  ];
         }

        //dynamic email need ConFMail.php

                   \Mail::to([$getEMail->email])->send(new \App\Mail\ConFMail($details));

         return back()->with('status', 'Reservation Status Change Successfully');
        // return view('admin.reservation', compact('reservation'));
    }


   /// cateren
   

     public function caterer()
    {
        $catren = catren::latest()->get();
        return view('admin.caterer', compact('catren'));
    }

    
    public function catererShow($id)
    {   
        return $reservation = catren::find($id);
        // return view('admin.reservation', compact('reservation'));
    }
    public function catererStatus(Request $request)
    {   
        $reservationID = $request->reserID;
        $status = $request->status;
         $reservation = catren::where('id', $reservationID)->update([
            'status' => $status
         ]);
         return back()->with('status', 'Catren Status Change Successfully');
        // return view('admin.reservation', compact('reservation'));
    }
    
    public function scheduleIndex()
    {   
        $schedule = Schedule::all();
         return view('admin.openSchedules', compact('schedule'));
    } 
    public function openSchedulesSave(Request $request)
    {   
        $schedule = new Schedule();
        $schedule->name = $request->name;
        $schedule->save();
         return back();
    } 
    public function openSchedulesDelete($id)
    {   
        $schedule =  Schedule::find($id);
        $schedule->delete();
    }
    
    

    function profileIndex(){

        $id = AUTH::user()->id;
         $siteSetting = Admin::findOrfail($id);
        return view('admin.profile.setting', compact('siteSetting'));
    }
    function changePassword(Request $request){

          $this->validate($request,[
                    'old_password' => 'required',
                    'password' => 'required|confirmed'
                  
                ]);

            $hashPassword = Auth::user()->password;

           if(Hash::check($request->old_password,$hashPassword)){

                    if(!Hash::check($request->password,$hashPassword)){

                        $user = Admin::find(Auth::id());
                        $user->password = Hash::make($request->password);
                        $user->save();
                            Auth::logout();
                            return redirect()->back()->with('status', 'Your Password has been Change');

                    }else{

                        return redirect()->back()->with('status', 'NEw Password can not be same old password:)');
                    }

           }else{
               return redirect()->back()->with('status', 'You pu wrong Password try aging');
           }

        return view('admin.profile');
    
    }
    function changeInfo(Request $request){

       $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email'
          
        ]);
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $updateUser = Admin::findOrfail($id)->update([
        'name' => $name,
        'email' => $email
         ]);
        return redirect()->back()->with('status', 'You Information Update Successfully');
    }


    public function calendarIndex()
    {
        // return "df";
        return view('admin.cal');
    }
     public function pointIndex()
    {
        $points = \App\Models\Point::all();
        $pls = \App\Models\PointList::where('status', 1)->get();
        return view('admin.point', compact('points','pls'));
    }
public function pointSave(Request $request)
    {
        $po = new Point();
        $po->name = $request->name;
        $po->am = $request->am;
        $po->total = $request->total;
        $po->save();
        return back();
    }public function pointlistSave(Request $request)
    {
        $po = new PointList();
        $po->name = $request->name;
        $po->total = $request->total;
        $po->save();
        return back();
    }
public function pointDelete($id)
    {
        $po = Point::find($id);
        $po->delete();
        // return view('admin.point');
        return back();
    }
    public function plsDelete($id)
    {

      // return dd(PointList::find(intval($id)));
        $po = PointList::find(intval($id))->update(['status' => 2]);

        // return view('admin.point');
        return back();
    }

    public function getDIscountPoint($id)
    {
      return back()->with('success', 'vous avez pris le bon avec succès, allez maintenant à la page de paiement et voyez votre réduction');
    }

    public function pointDeletList($value)
    {

        $po = PointList::find($value);
        $po->delete();
        // return view('admin.point');
        return back();
    }


}
