<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\catren;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\SetMenu;
use App\Models\Banner;
use App\Models\HomePage;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\SetmenuCategory;
use App\Models\SetmenuProduct;
use App\Models\Coupon;
use App\Models\OurPage;
use App\Models\setting;
use App\Models\Review;
use Illuminate\Support\Str;
class MainController extends Controller
{



    function index()
    {

    // return    $ne = \App\Models\SubCategory::where('is_promo', 1)->orderBy('id', 'DESC')->with('products')->get();
        // $get = $_SERVER;
        // $arr_ip = geoip()->getLocation('103.137.108.30');
        // // dd($get);
        // dd($arr_ip);
        // echo $arr_ip->country; // get a country
        // echo $arr_ip->currency; // get a currency

        // die();

        $homePage = HomePage::find(1);
        $setting = setting::findOrFail(1);

// return       $banner = Product::where('status', 1)
//                          ->where('status', 1)
//                          ->where('is_pro', 2)
//                          ->get();
       // $categoryPromoted = Category::where('setcat', 1)->where('status',1)->get();

            // return view('layouts.website', compact('homePage'));
            return view('front.index', compact('homePage'));

    }


    public function index1()
    {
        $homePage = HomePage::find(1);
        return view('front.index1', compact('homePage'));
    }

    public function review()
    {
        $getRe = Review::orderBy('id', 'desc')->get();
        return view('front.review', compact('getRe'));
    }
     public function aboutUs()
    {
        $homePage = HomePage::find(1);
        return view('front.aboutUs', compact('homePage'));
    }
     public function contactUs()
    {
        $st = \App\Models\setting::find(1);
        return view('front.contactUs', compact('st'));
    }
    public function catering()
    {
        return view('front.catering');
    }

    public function menu()
    {
     // return   $ne = \App\Models\SubCategory::withCount('products')
     //                                          ->latest('products_count')
     //                                          ->with('products')
     //                                          ->get();
        // $ne = \App\Models\SubCategory::withCount('products')
        //                                       ->latest('products_count')
        //                                       ->with('products')
        //                                       ->get();

        // $ne = \App\Models\SubCategory::where('status', 1)
        //                              ->with('products')
        //                              ->orderBy('id', 'DESC')
        //                              ->get();

    $category = Category::withCount('products')
                                   ->latest('products_count')
                                   ->where('status', 1)
                                   ->get();



        return view('front.menu', compact('category'));
    }
    public function subCatView($slug)
    {
        $category = Category::where('slug', $slug)
                                   ->where('status', 1)
                                   ->with('subcategory')
                                   ->first();
        $productCount = Product::where('category_id', $category->id)
                                ->where('sub_category_id', 0)
                                ->where('status', 1)
                                ->exists();
        $onlyCat = Product::where('category_id', $category->id)
                                ->where('sub_category_id', 0)
                                ->where('status', 1)
                                ->count();
        $onlyMenu = Product::where('category_id', $category->id)
                                ->where('status', 1)
                                ->count();

        $subCount = SubCategory::where('category_id', $category->id)
                                ->where('status', 1)
                                ->count();

        return view('front.subCat', compact('category','productCount','onlyCat','onlyMenu','subCount'));
    }

     public function viewMenusItems()
    {
        $id = 10;
        $category = Category::where('id', $id)
                                   ->where('status', 1)
                                   ->with('subcategory')
                                   ->first();
        $productCount = Product::where('category_id', $category->id)
                                ->where('sub_category_id', 0)
                                ->where('status', 1)
                                ->exists();
        $onlyCat = Product::where('category_id', $category->id)
                                ->where('sub_category_id', 0)
                                ->where('status', 1)
                                ->count();
        $onlyMenu = Product::where('category_id', $category->id)
                                ->where('status', 1)
                                ->count();

        $subCount = SubCategory::where('category_id', $category->id)
                                ->where('status', 1)
                                ->count();
        return view('front.menus', compact('category','productCount','onlyCat','onlyMenu','subCount'));
    }




    public function mainMenu()
    {

//         $category = Category::first();
//  return       $apps = $category->products()->paginate(10);



// return        $category = Category::withCount('products')
//                                    ->latest('products_count')
//                                    ->where('status', 1)
//                                    ->paginate(5);

// return        $category = Category::withCount('products')
//                                    ->latest('products_count')
//                                    ->where('status', 1)
//                                    ->with('products')
//                                    ->get();
        return view('front.mainMenu');
    }

    public function cateList($data)
    {
       

       return view('front.customProduct', compact('data'));
    }

    public function searchProduct(Request $request)
    {
        $geP =  $request->querySe;
        
        $query = Product::where('name','LIKE',"%$geP%")->where('status', 1)->get();

        return view('front.search', compact('query'));
    }



    function couponCHeck(Request $request){
        // return "df";
        $cartId = auth()->user()->cartToken();
        $userCart = session()->get($cartId, collect([]));
$couponExists  = Coupon::where('name', $request->coupon)->exists();
if(!$couponExists){
    return redirect()->route('checkout.index')->with('status','This Promo Code Not Exists Try New One');
}
        $coupon = Coupon::where('name', $request->coupon)->first();

        $percentise = $coupon->content;
        $amount = $userCart->get("pay_amount");

        if($coupon->type == 1) {
            $pay_amount =  ($amount  *  $percentise) / 100;
             $finalTotal = $userCart->get("pay_amount") - $pay_amount;
        }elseif($coupon->type == 2) {
            $pay_amount = $userCart->get("pay_amount") - $coupon->content;
             $finalTotal =  $pay_amount;
            
        }
        
        // dd($pay_amount);

      session()->put($cartId, collect([
            "items" => $userCart->get("items"),
            "pay_amount" => $finalTotal,
            "total_quantity" => $userCart->get("total_quantity"),
            "coupon_code" => $request->coupon,
            "discount_c" => $pay_amount
        ]));
//         $userCart2 = session()->get($cartId, collect([]));
// dd($userCart2);


        // session()->flash("coupon_added", $pay_amount);
        return back();
    }









    public function getOrderTone(Request $request)
    {
        return $order = Order::where('pageView', 1)->get();
    }
//contact

    public function contactPage()
    {
        $ourPage = OurPage::find(1);
        return view('front.contactPage', compact('ourPage'));
    }


//view Category

    public function viewCategory($slug)
    {
      $getCategory = Category::where('slug', $slug)->first();
        $getCategoryProduct = Product::where('category_id', $getCategory->id)
                                      ->where('status', 1)
                                      ->whereNull('sub_category_id')
                                      ->get();

         // $subCategory = SubCategory::where('category_id', $getCategory->id)->where('status', 1)->get();
         $subCategory = SubCategory::where('category_id', $getCategory->id)->where('status', 1)->with('products')->get();
         // $getSubCategoryProduct = Product::where('sub_category_id', $getCategory->id)->where('status', 1)->get();
        return view('front.productShow', compact('getCategoryProduct','getCategory','subCategory'));
    }
    
    
    //view sub category 
    
        public function viewSubCategory($slug)
    {
        $getCategory = SubCategory::where('slug', $slug)->first();
        $getProduct = Product::where('sub_category_id', $getCategory->id)->where('status', 1)->get();

         $subCategory = SubCategory::where('category_id', $getCategory->category_id)->where('status', 1)->with('products')->get();

        return view('front.productShowCat', compact('getProduct','getCategory','subCategory'));
    }

    //set category view

    public function setmenuCategory()
    {
        $setMenu = SetMenu::where('status', 1)->get();
        // $getSetmenucat = Category::where('slug', $slug)->first();
        // $getsubcategory = SubCategory::where('category_id', $getSetmenucat->id)->get();
        return view('front.subCategory', compact('setMenu'));
    }

    public function setCatView($id)
    {
        // $category = Category::where('setcat',1)->get();
        // $allProduct = SetmenuProduct::where('status', 1)->get();
        $setMenu = SetMenu::where('status', 1)->where("id", $id)->first();

        $allcategory = SetmenuCategory::where('set_menu_id', $id)->where('status', 1)->with('subproduct')->get();
        return view('front.setCatView', compact('allcategory', "setMenu"));
    }


///Reservation
    public function reservation()
    {
        return view('front.reservation');
    }

    public function reservationSave(Request $request)
    {
        // return "hey";
        // return $request->all();


        $this->validate($request, [
            'name' => 'required',
            'numberOfGuest' => 'required',
            'number' => 'required',
            'date' => 'required',
            'time' => 'required'

        ]);


        $reservation = new Reservation();
        $reservation->name = $request->name;
        $reservation->numberOfGuest = $request->numberOfGuest;
        $reservation->email = "abc@gmail.com";
        $reservation->number = $request->number;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->msg = $request->msg;
        $reservation->save();


        $details = [
                  'title' => 'Mail from Jardin de Kashmir',
                  'body' => 'you have just received a reservation form-'. $request->name . 'phone number-'.$request->number,
                  'priority' => 'This is for testing email using smtp',
                  'from' => 'from',
                  'sender' => 'Jardin de Kashmir',
                  'to' => 'to',
                  'cc' => 'cc',
                  'bcc' => 'bcc',
                  'replyTo' => 'replyTo',
                  'subject' => 'subject',
                  ];

        //dynamic email need ConFMail.php

                  \Mail::to(['info@restaurantrajmahal.fr'])->send(new \App\Mail\OrderMail($details));

        // return $request->all();
        // Reservation
        return back()->with('status', 'Your Reservation Take Successfully.');
    }


    ///caterer

    public function caterer()
    {
        return view('front.caterer');
    }

    public function catererSave(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:50|string',
            'nameOfEvent' => 'required|max:70|string',
            'numberOfGuest' => 'required|max:3',
            'number' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'place' => 'required',
            'msg' => 'required',
            'budget' => 'required',

        ]);

        $catren = new catren();
        $catren->name = $request->name;
        $catren->nameOfEvent = $request->nameOfEvent;
        $catren->numberOfGuest = $request->numberOfGuest;
        $catren->email = $request->email;
        $catren->number = $request->number;
        $catren->date = $request->date;
        $catren->time = $request->time;
        $catren->postcode = 'dd';
        $catren->place = $request->place;
        $catren->service = 'd';
        $catren->budget = $request->budget;
        $catren->society = 'dd';
        $catren->msg = $request->msg;
        $catren->save();

        return back()->with('status', 'Your catren Take Successfully.');
    }




}
