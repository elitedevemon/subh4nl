<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use DB;
class CustomController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function customer()
    {
    	$customer = User::orderBy('id', 'DESC')->get();
    // 	$customer = DB::table('users')->get();
    	return view('admin.customer.index', compact('customer'));
    }
}
