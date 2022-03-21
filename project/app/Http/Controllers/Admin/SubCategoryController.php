<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Image;
class SubCategoryController extends Controller
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
        $categories = SubCategory::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.category.subCategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =Category::where('status', 1)->get();
        return view('admin.category.subCategory.create', compact('category'));
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
            'category_id' => 'required',
            'des' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
          
        ]);
          function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
            }
            $categoryName = $request->name;
        $category = new SubCategory();
        $category->name = $categoryName;
        $category->slug = make_slug($categoryName);
        $category->category_id = $request->category_id;
        $category->des = $request->des;

         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'sub-category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,400)->save('storage/upload/subcategory/'.$imageName);

          $category->image = $imageName;

        }else {
            $category->image = "default.png";
        }
        if ($request->has('pro_img')) {
            $image=$request->file('pro_img');
          $imageName = 'sub-category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,400)->save('storage/upload/subcategory/'.$imageName);

          $category->pro_img = $imageName;

        }else {
            $category->pro_img = "default.png";
        }

        $category->status = 1;
        $category->save();
         return redirect('/admin/sub-category')->with('status', 'Your Sub Category Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maincategory =Category::where('status', 1)->get();
        $category = SubCategory::find($id);
        return view('admin.category.subCategory.update', compact('category','maincategory'));
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
          
         function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
            }
            $categoryName = $request->name;
        $category =  SubCategory::find($id);
        $category->name = $categoryName;
        $category->slug = make_slug($categoryName);
        $category->category_id = $request->category_id;
        $category->des = $request->des;

         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,400)->save('storage/upload/subcategory/'.$imageName);

          $category->image = $imageName;

        }else {
            $category->image = $category->image;
        }
        if ($request->has('pro_img')) {
            $image=$request->file('pro_img');
          $imageName = 'category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,400)->save('storage/upload/subcategory/'.$imageName);

          $category->pro_img = $imageName;

        }else {
            $category->pro_img = $category->image;
        }
        $category->status = 1;
        $category->save();
         return redirect('/admin/sub-category')->with('status', 'Your Sub Category Updated Successfully');
    }
    public function subCatepromoteStatus(Request $request)
    {
        $reservationID = $request->reserID;
        $status = $request->is_promo;
         $reservation = SubCategory::where('id', $reservationID)->update([
            'is_promo' => $status
         ]);
         return back()->with('status', 'Sub Category Promoted Into Home Page Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = SubCategory::where('id', $id)->update([
            'status' => 0
         ]);

        $prod = \App\Models\Product::where('sub_category_id', $id)->get();

        foreach ($prod as $key => $p) {
           \App\Models\Product::where('id', $p->id)->update(['status' => 1]);
        }
    }
}
