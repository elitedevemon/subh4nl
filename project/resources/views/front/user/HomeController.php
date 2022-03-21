<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderList;
use App\Models\Customer;
use App\Models\OrderProduct;
use App\Models\Review;
use App\Models\Voucher;
use App\Models\setting;
use App\Models\CusPoint;
use PDF;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function sp()
    {
   // return   DB::table('shippings')
   //             ->select('*')
   //             ->addSelect(DB::raw('cost as current_price'))
   //             ->orderBy('current_price',  request('current_price', 'DESC'))
   //             ->get();

         $ss2 = \App\Models\Shipping::where('km', '>=', 10)
                    ->orderBy('id', 'asc')->take(1)->get();
                     $cc = count($ss2);

                    if ($cc != 0) {
                        foreach ($ss2 as $key => $value) {
                        # code...
                      return 'sd';
                      // return $value->cost;
                      }
                    }else{
                      return "boro";
                    }

    }


    public function dd($id){

     $items = Order::find($id);


      // share data to view
      view()->share('items',$items);
      $pdf = PDF::loadView('home', $items);

      // download PDF file with download method
      return $pdf->stream('pdf_file.pdf');
    }

public function getDownload()
{

  $setting = setting::find(1);
  $fineName = 'storage/upload/logo/'.$setting->is_menu;

  return $fineName;
//   $path = storage_path($fineName);
//    $headers = array(
//               'Content-Type: application/pdf',
//             );
// return Response::stream(file_get_contents($path), 200, [
//     'Content-Type' => 'application/pdf',
//     'Content-Disposition' => 'inline; filename="'.$setting->is_menu.'"'
// ]);

  // $user = UserDetail::find($user->id);
  // $data["info"] = $setting->is_menu;
  // $pdf = PDF::loadView('whateveryourviewname', $data);
  // return $pdf->stream('whateveryourviewname.pdf');

//     //PDF file is stored under project/public/download/info.pdf
//     $file= 'project/storage/upload/logo/'. $setting->is_menu;

//     $headers = array(
//               'Content-Type: application/pdf',
//             );

// return Response::make(file_get_contents('project/storage/upload/logo/'), 200, [
//     'Content-Type' => 'application/pdf',
//     'Content-Disposition' => 'inline; filename="'.$setting->is_menu.'"'
// ]);

// return response()->file($file, $headers);
    // return Response::download($file, 'menu.pdf', $headers);
}


    public function myAccount()
    {

      // $cuPont = \App\Models\Customer::where('user_id', auth()->user()->id)->sum('point');

      // $cu = \App\Models\Customer::where('user_id', auth()->user()->id)
      //                           ->update(['point' => 200]);



      $userR = Review::where('user_id', auth()->user()->id)->first();
        return view('front.user.myAccount', compact('userR'));
    }

    public function myReview(Request $request)
    {

      $userExists = Review::where('user_id', auth()->user()->id)->exists();

      if ($userExists) {
        Review::where('user_id', auth()->user()->id)->update([
          'user_id' =>  auth()->user()->id,
          'review' =>   $request->review,
          'star' =>     $request->star,
        ]);
      }else{
        $re = new Review();
        $re->user_id = auth()->user()->id;
        $re->review = $request->review;
        $re->star = $request->star;
        $re->save();
      }

      return back();
    }

    public function myInfoSave(Request $request)
    {
         $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $id = auth()->user()->id;

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('status', 'your information updated successfully');
    }
    public function myPassSave(Request $request)
    {
                 $this->validate($request,[
                    'old_password' => 'required',
                    'password' => 'required|confirmed'
                ]);

            $hashPassword = Auth::user()->password;

           if(Hash::check($request->old_password,$hashPassword)){

                    if(!Hash::check($request->password,$hashPassword)){

                        $user = User::find(Auth::id());
                        $user->password = Hash::make($request->password);
                        $user->save();
                            Auth::logout();
                            return redirect()->route('index');

                    }else{

                        return redirect()->back()->with('status', 'NEw Password can not be same old password:)');
                    }

           }else{
               return redirect()->back()->with('status', 'You put wrong Password try aging');
           }

        return back();
    }
    public function myAddress()
    {
        $cus = Customer::where('user_id', auth()->user()->id)->first();
        return view('front.user.myAddress', compact('cus'));
    }

    public function saveAddress(Request $request)
    {
        Customer::where('user_id', auth()->user()->id)->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return back();
    }

    public function myOrder()
    {

       // return $pli = \App\Models\PointList::all();
       return $pli = \App\Models\CusPoint::where('name', $val->name)->all();
        $orderSum = Order::where('user_id', auth()->user()->id)->sum('pay_amount');

        foreach ($pli as $key => $val) {
          if ($orderSum > $val->total) {
            $cusPointE = CusPoint::where('name', $val->name)->exists();
            if (!$cusPointE) {
              CusPoint::create([
                'name' => $val->name,
                'total' => $val->total,
                'customer_id' => 0,
                'user_id' => auth()->user()->id,
              ]);
            }
          }
        }


        $order = Order::where('user_id', auth()->user()->id)
                       ->orderBy('id', 'DESC')
                       ->get();
        return view('front.user.myOrder', compact('order'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = AUTH::user()->id;
        $getUserOrder = Order::where('user_id', $userId)->get();
        return view('home', compact('getUserOrder'));
    }
    public function orderDetails($id)
    {

        $getOrder = Order::find($id);
        $getOrderProduct = OrderProduct::where('order_id', $getOrder->id)->with('product')->with('setmenu')->get();

        return view('details',compact('getOrder','getOrderProduct'));
    }
   public function getDIscountPoint($id)
    {
            $t = 0;
            $d = intval($id);
            $t += $d;

        $getVoucher = session()->get('getVoucher');

        if (session()->get('getVoucher') == null) {
                    $getVoucher = [
                        'status' => 3,
                        'am' => $t,
                    ];
        }else{
            $neT = $getVoucher['am'] + $t;


            $getVoucher = [
                        'status' => 3,
                        'am' => $neT,
                    ];
                    
        }


session()->put('getVoucher', $getVoucher);



      $ee = \App\Models\Voucher::where('user_id', auth()->user()->id)
                                     ->where('am', $id)
                                     ->update(['status' => 0]);


        return back()->with('status', 'Voucher Add Successfully Go To Checkout Page');
    }

    public function getaVa($value)
    {
      $ee = \App\Models\Customer::where('user_id', auth()->user()->id)
                                ->increment('point', $value);
                                return back();
    }
}
