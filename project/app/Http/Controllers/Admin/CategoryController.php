<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->where('status', 1)->get();
       return view('admin.category.index', compact('categories'));
    }


    public function promoteStatus(Request $request)
    {
        $reservationID = $request->reserID;
        $status = $request->setCat;
         $reservation = Category::where('id', $reservationID)->update([
            'setcat' => $status
         ]);
         return back()->with('status', 'Category Promoted Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.category.create');
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
            'des' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
          
        ]);
          function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
            }
            $categoryName = $request->name;
        $category = new Category();
        $category->name = $categoryName;
        $category->slug = make_slug($categoryName);
        $category->des = $request->des;

        if ($request->setmenu == 1) {
            # code...
        $category->setmenu = $request->setmenu;
        $category->setcat = 0;
        }else{
            $category->setmenu = $request->setmenu;
            $category->setcat = 1;
        }

         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,400)->save('storage/upload/category/'.$imageName);

          $category->image = $imageName;

        }else {
            $category->image = "default.png";
        }

         if ($request->has('promo_image')) {
            $image=$request->file('promo_image');
          $imageName = 'promo_image'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(728,90)->save('storage/upload/category/'.$imageName);

          $category->promo_image = $imageName;

        }else {
            $category->promo_image = "default.png";
        }

        $category->status = 1;
        $category->save();
         return redirect('/admin/category')->with('status', 'Your Category Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.update', compact('category'));
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

        // return $request->all();
        
         function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
            }
            $categoryName = $request->name;
        $category = Category::find($id);
        $category->name = $categoryName;
        $category->slug = make_slug($categoryName);
        $category->des = $request->des;
        $category->setmenu = 1;
         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,400)->save('storage/upload/category/'.$imageName);

          $category->image = $imageName;

        }else {
            $category->image = $category->image;
        }

         if ($request->has('promo_image')) {
            $image=$request->file('promo_image');
          $imageName = 'promo_image'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(728,90)->save('storage/upload/category/'.$imageName);

          $category->promo_image = $imageName;

        }else {
            $category->promo_image = $category->promo_image;
        }



        $category->status = 1;
        $category->save();
         return redirect('/admin/category')->with('status', 'Your Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // return $id;

       $reservation = Category::where('id', $id)->update([
            'status' => 0
         ]);

    }
}
