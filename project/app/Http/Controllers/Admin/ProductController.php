<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProTitle;
use App\Models\ProductOption;
use App\Models\SubCategory;
use App\Models\Sale;
use Image;
class ProductController extends Controller
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
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
       return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proTitle = ProTitle::all();
        $category = Category::where('status', 1)->get();
       return view('admin.product.create', compact('category','proTitle'));
    }


    function PricePromoteStatus(Request $request){
   

        // return $request->all();

        $id = $request->reserID;
        $priceStatus = $request->is_pro;

        if($priceStatus == 2){
            $product = Product::find($id);


        if ($request->has('dealImage')) {
            $image=$request->file('dealImage');
          $imageName3 = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(635,400)->save('storage/upload/product/'.$imageName3);

          $product->update([
                'is_pro' => 2,
                'dealImage' => $imageName3,
            ]);

        }
            $product->update([
                'is_pro' => 2,
            ]);

        return back()->with('status', 'Product will Promoted');
        }elseif($priceStatus == 1){
              $product = Product::find($id)->update([
                'is_pro' =>1
            ]);

        return back()->with('status', 'Product will Promoted');
        }else{
            $product = Product::find($id);
            $product->update([
                'is_pro' =>$product->is_pro,
            ]);

        if ($request->has('dealImage')) {
              $image=$request->file('dealImage');
              $imageName3 = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

              $post = Image::make($image)->resize(635,400)->save('storage/upload/product/'.$imageName3);

              $product->update([
                    'dealImage' => $imageName3,
                ]);

            }
             return back()->with('status', 'Product will Promoted');

        }

    }


    public function getSubCategory(Request $request)
    {

        // return $_POST['category_id'];
        $stringToSend = '<option value="">-Select-</option>';
        $upazillaLists = SubCategory::where('category_id', $_POST['category_id'])->where('status', 1)->get();
        foreach($upazillaLists as $upazillaList){
        $stringToSend = $stringToSend.'<option value="'.$upazillaList->id.'">'.$upazillaList->name.'</option>';
        }
        echo $stringToSend;
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
            'regular_price' => 'required',
            'category_id' => 'required',
            'offer_price' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
            }
        $proName = $request->name;
        $product = new Product();
        $product->name = $proName;
        $product->slug = make_slug($proName);
        $product->des = $request->des;
        $product->sp_des = $request->sp_des;
        $product->is_banner = $request->is_banner;
        if(isset($request->is_promo)){
            $product->is_promo = $request->is_promo;
         }
         if(isset($request->taxable)){
            $product->taxable = $request->taxable;
         }
         if(isset($request->discountable)){
            $product->discountable = $request->discountable;
         }

        $product->category_id = $request->category_id;
        if ($request->sub_category_id == null) {
            $product->sub_category_id = 0;
        }else{
            $product->sub_category_id = $request->sub_category_id;
        }

        $product->product_option = $request->product_option;
        $product->offer_price = $request->offer_price;
        $product->regular_price = $request->regular_price;
        $product->tax = $request->tax;

         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(268,200)->save('storage/upload/product/'.$imageName);

          $product->image = $imageName;

        }else {
            $product->image = "default.png";
        }

         if ($request->has('banner')) {
            $image=$request->file('banner');
          $imageName2 = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,400)->save('storage/upload/product/'.$imageName2);

          $product->banner = $imageName2;

        }else {
            $product->banner = $product->banner;
        }

        $product->status = 1;
        $product->save();
         return redirect('/admin/product')->with('status', 'Your Product Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proTitle = ProTitle::all();
       $category = Category::where('status',1)->get();
       $subcategory = SubCategory::where('status',1)->get();
       $product = Product::find($id);
       return view('admin.product.edit', compact('product', 'category','subcategory','proTitle'));
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
        $product = Product::find($id);

        function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
            }
        $proName = $request->name;
        $product->name = $proName;
        $product->slug = make_slug($proName);
        $product->des = $request->des;
        $product->sp_des = $request->sp_des;
        $product->is_banner = $request->is_banner;
        // $product->is_promo = $request->is_promo;
        $product->tax = $request->tax;


        if (empty($request->is_promo)) {
            $product->is_promo = 0;
        }else{
            $product->is_promo = $request->is_promo;
        }
        if (empty($request->taxable)) {
            $product->taxable = 0;
        }else{
            $product->taxable = $request->taxable;
        }
        if (empty($request->discountable)) {
            $product->discountable = 0;
        }else{
            $product->discountable = $request->discountable;
        }
        

            // // if ($product->is_promo == null) {
            // //     $product->is_promo = 0;
            // // }else{
            //     $product->is_promo = $request->is_promo;
            // // }


        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->offer_price = $request->offer_price;
        $product->regular_price = $request->regular_price;
        if ($request->sub_category_id == 0) {
            $product->sub_category_id = 0;
        }else{
            $product->sub_category_id = $request->sub_category_id;
        }

        $product->product_option = $request->product_option;

         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(268,200)->save('storage/upload/product/'.$imageName);

          $product->image = $imageName;

        }else {
            $product->image = $product->image;
        }

        if ($request->has('banner')) {
            $image=$request->file('banner');
          $imageName = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(651,615)->save('storage/upload/product/'.$imageName);

          $product->banner = $imageName;

        }else {
            $product->banner = $product->image;
        }


        $product->status = 1;
        $product->save();
         return redirect('/admin/product')->with('status', 'Your Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $reservation = Product::where('id', $id)->update([
            'status' => 0
         ]);
    }



// productOption

    public function productOption()
    {
      $proTitle = ProTitle::all();
      $productOption = ProductOption::all();
      return view('admin.product.option', compact('proTitle', 'productOption'));
    }

   
public function proTitle(Request $request)
{
        $newV = ProTitle::create($request->all());

        return back();
}

public function pro_title_edit($id)
{
  $proTitle = ProTitle::find($id);

  // ->whereIn('pro_title_id', $proTitle->id)->delete()
  $productOption = ProductOption::where('pro_title_id', $id)->get();
   // $proTitle->delete();

   return view('admin.product.proView', compact('proTitle','productOption'));
}

public function optionsEdit(Request $request)
{
  $id = $request->id;
  $name = $request->name;
   $proTitle = ProTitle::find($id)->update([
      'name' => $name
   ]);

   return back();
}

public function getOptionStore(Request $request)
{
        $product = new ProductOption();
        $product->name = $request->name;
        $product->pro_title_id = $request->pro_title_id;
        $product->price = $request->price;
        $product->des = $request->des;

        if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'product'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(268,200)->save('storage/upload/product/'.$imageName);

          $product->image = $imageName;

        }else {
            $product->image = "default.png";
        }
        $product->save();


        return back();
    }
    public function optionsDelete($id)
    {
       $proTitle = ProductOption::find($id)->delete();
       return back();
    }
    public function pro_title_delete($id)
    {
      $proTitle = ProTitle::find($id);

      // ->whereIn('pro_title_id', $proTitle->id)->delete()
      $deleteData = ProductOption::where('pro_title_id', $proTitle->id)->delete();
       $proTitle->delete();

       return back();
    }

     ///new Sale


    public function saleView()
    {
        $productOption = Product::where('is_pro', 2)
                                 ->where('status', 1)
                                 ->withCount('saleP')
                                 ->get();
        return view('admin.product.saleView', compact('productOption'));
    }

    public function sale($id)
    {
        $productOption = Sale::where('product_id', $id)->get();
        return view('admin.product.sale', compact('id', 'productOption'));
    }

    public function saleSave(Request $request)
    {
        $sale = new Sale();
        $sale->product_id = $request->id;
        $sale->name = $request->name;

         if ($request->has('img')) {
            $image=$request->file('img');
          $imageName = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(268,200)->save('storage/upload/product/'.$imageName);

          $sale->img = $imageName;

        }else {
            $sale->img = "default.png";
        }
            $sale->save();
            return back();
    }

    public function saleDelete($id)
    {
        $dd = Sale::find($id);
        $dd->delete();

        return back();
    }

    public function salePromoteStatus(Request $request)
    {
         $request->all();
        $id = $request->reserID;
        $sale_limit = $request->sale_limit;


            $product = Product::find($id);
            $product->update([
                'sale_limit' => $sale_limit,
            ]);

        return back()->with('status', 'Product Limit Add Successfully');
    }





}
