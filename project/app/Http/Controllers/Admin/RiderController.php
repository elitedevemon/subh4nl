<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Rider;
use Carbon\Carbon;
class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $riders = Rider::latest()->get();
        return view('admin.rider.index', compact('riders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rider.create');
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request,[
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => 'required',
            'phone' => 'required'
        ]);
   
        $password = Hash::make($request['password']);

        $rider = new Rider();
        $rider->name = $request->name;
        $rider->address = $request->address;
        $rider->email = $request->email;
        $rider->phone = $request->phone;
        $rider->password = $password; 
        $rider->save(); 
        return redirect('/admin/rider')->with('status', 'Your Rider Information Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $rider = Rider::find($id);

       return view('admin.rider.update', compact('rider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $password = Hash::make($request['password']);

        $rider =  Rider::find($id);
        $rider->name = $request->name;
        $rider->address = $request->address;
        $rider->email = $request->email;
        $rider->phone = $request->phone;
        $rider->password = $rider->password; 
        $rider->save(); 
        return redirect('/admin/rider')->with('status', 'Your Rider Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
