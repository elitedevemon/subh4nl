<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
class Cartcontroller extends Controller
{
    function cartStore(Request $request)
    {
        // dd($request->all());
        $cartId = auth()->user()->cartToken();
        session()->put($cartId, collect($request->all()));
        return redirect()->to(route("checkout.index"));
    }

    function cartIndex(Request $request)
    {
       
        return view('front.cart');
    }
}
