<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
class CouponController extends Controller
{
    public function coupon()
    {
    	 $coupon = Coupon::latest()->get();
    	return view('admin.coupon', compact('coupon'));
    } 

      public function couponStatus(Request $request)
    {
    	 $coupon = Coupon::create($request->all());

    	 return back()->with('status', 'Coupon Add Successfully');
    }  
      public function couponDelete($id)
    {
    	 $coupon = Coupon::find($id);
    	 $coupon->delete();

    	 // return back()->with('status', 'Coupon Deleted Successfully');
    }
}
