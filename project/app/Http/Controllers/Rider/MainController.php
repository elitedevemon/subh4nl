<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Rider;
use App\Models\OrderProduct;
class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $this->middleware('auth:rider');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('rider.dashboard');
    }

       public function orderIndex(){
            $order = Order::where('pageView', 1)
                            ->where('orderType', 'order')
                            ->latest()
                            ->get();
            return view('rider.order.index', compact('order'));
        }


    public function orderView($id){

        $reservation = Order::where('id', $id)->update([
            'riderView' => 1
         ]);
        return back();

        // $getOrder = Order::find($id);
        // $getOrderProduct = OrderProduct::where('order_id', $getOrder->id)->with('product')->with('setmenu')->get();

        return view('rider.order.viewOrder',compact('getOrder'));
    }

    public function getOrderToneRider(Request $request)
    {
        return $order = Order::where('pageView', 1)
                                 ->where('orderType', 'order')
                                 ->where('riderView', 0)
                                 ->get();
    }


    public function googleMap($id)
    {
         $getOrder = Order::find($id);
         return view('rider.order.googleMap', compact('getOrder'));
    }

     public function deliveryStatus($id)
    {   
        $reservationID = $id;
        $status = 1;
         $reservation = Order::where('id', $reservationID)->update([
            'deliveryStatus' => $status
         ]);
         return back()->with('status', 'Order Status Change Successfully');
        // return view('admin.reservation', compact('reservation'));
    }

    function profileIndex(){

        $id = AUTH::user()->id;
         $siteSetting = Rider::findOrfail($id);
        return view('rider.profile', compact('siteSetting'));
    }
    function changePassword(Request $request){

          $this->validate($request,[
                    'old_password' => 'required',
                    'password' => 'required|confirmed'
                  
                ]);

            $hashPassword = Auth::user()->password;

           if(Hash::check($request->old_password,$hashPassword)){

                    if(!Hash::check($request->password,$hashPassword)){

                        $user = Rider::find(Auth::id());
                        $user->password = Hash::make($request->password);
                        $user->save();
                            Auth::logout();
                            return redirect()->back()->with('status', 'Your Password has been Change');

                    }else{

                        return redirect()->back()->with('status', 'NEw Password can not be same old password:)');
                    }

           }else{
               return redirect()->back()->with('status', 'You password wrong Password try aging');
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
        $updateUser = Rider::findOrfail($id)->update([
        'name' => $name,
        'email' => $email
         ]);
        return redirect()->back()->with('status', 'You Information Update Successfully');
    }



}
