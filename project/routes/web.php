<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Models\Coupon;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RiderController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\Front\Cartcontroller;
use App\Http\Controllers\Front\Checkoutcontroller;
use App\Http\Controllers\Front\PlaceOrderController;
use App\Http\Controllers\GoogleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('send-mail', function () {

//     $details = [
//         'title' => 'Mail from Jardin de Kashmir',
//         'body' => 'This is for testing email using smtp',
//         'priority' => 'This is for testing email using smtp',
//         'from' => 'from',
//         'sender' => 'Jardin de Kashmir',
//         'to' => 'to',
//         'cc' => 'cc',
//         'bcc' => 'bcc',
//         'replyTo' => 'replyTo',
//         'subject' => 'subject',
//     ];


//     \Mail::to('iftekhar0967@gmail.com')->send(new \App\Mail\MyTestMail($details));
//     dd("Email is Sent.");
// });


Route::get('qr', function(){
	return view('qr');
});


Route::get('/menus', [MainController::class, 'viewMenusItems'])->name('viewMenusItems');

Route::get('csv', function(){

// $dd = $_SERVER['REQUEST_URI'];
// $dd = str_replace('/', '', $dd);
// // $dd = request()->getHost();
// dd($dd);


	   $fileName = 'tasks.csv';
   $tasks = \App\Models\User::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Email', 'First Name', 'Last Name', 'Address');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Email']  = $task->email;
                $row['First Name']    = $task->name;
                $row['Last Name']    = $task->name;
                $row['Address']  = 'none';

                fputcsv($file, array($row['Email'], $row['First Name'], $row['Last Name'], $row['Address']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);


});

Route::post('send-mail', [GeneralController::class, 'sendMailUser'])->name('sendMail');

Route::get('dd/{id}', [App\Http\Controllers\HomeController::class, 'dd'])->name('download');
Route::get('download-menu', [App\Http\Controllers\HomeController::class, 'getDownload'])->name('m.download');


Route::get('oo', function(){
	$items = \App\Models\Order::where('user_id', auth()->user()->id)
                       ->orderBy('id', 'DESC')
                       ->get();
	return view('home', compact('items'));
});

// Route::get('/', function () {
//     event(new App\Events\RealTimeMessage('Hello World'));

// });

// Route::post("/coupon/check", function(Request $request) {
// 		$cartId = auth()->user()->cartToken();
//         $userCart = session()->get($cartId, collect([]));

// 		// $data = $this->validate($request,[
//   //           'coupon' => 'required'
          
//   //       ]);

// 		$coupon = Coupon::where('discount_amount', $request->coupon)->first();

// 		if($counpon->type == 1) {
// 			$pay_amount =  ($coupon->discount_amount / 100) * $userCart->get("pay_amount");
// 		}else {
// 			$pay_amount = $userCart->get("pay_amount") - $coupon->discount_amount;
// 		}

//         session()->put($cartId, collect([
//         	"items" => $userCart->get("items"),
//         	"pay_amount" => $pay_amount,
//         	"coupon_code" => $data["coupon"]
//         ]));

//         // session()->flash("coupon_added", $pay_amount);
//         return back();

// })->name("coupon.chesck");

// Route::get('/', [MainController::class, 'index']);

Route::get('/cc', function(){

	$sub = \DB::table('shippings')
    ->groupBy('km')
    ->select('km', DB::raw('min(cost) as minPrice'));

return \DB::table('shippings')
    ->join(\DB::raw('(' . $sub->toSql() . ') as sub'), function ($join) {
        $join->on('sub.minPrice', '=', 'shippings.cost');
        $join->on('sub.km', '=', 'shippings.km');
    })
    ->groupBy('shippings.km','desc')
    ->get(['shippings.*']);



	return $ss2 = \App\Models\Shipping::where('km', '>=', 3)
									  ->orderBy('km', 'desc')
									  // ->take(1)
	                                  // ->max('cost');
	                                  ->get();
	 $ss = \App\Models\Shipping::all();
	$ss1 = 0;
	foreach ($ss as $key => $value) {
		if ($value->km > 90 || 90 > $value->km) {
			return $value->km;
		}
		// if ($value->km > 99) {
		// 	# code...
		// }
	}
	dd('da');
	// return $ss1;
	// return Session::flush('orderPart');
	// return Session::flush('isOffer');

        dd(session('orderPart'));
});
Route::get('/cd', function(){
// return Session::flush('getVoucher');
// return "ds";
	// if (session()->get('getVoucher') == null) {
	// 	dd('d');
	// }
dd(session()->get('getVoucher'));
// dd(session()->get('orderPart'));


	$to = '2021-10-20'; //ending date
	$from = '2021-10-19'; //starting date


	// return \App\Models\Order::orderBy('id', 'desc')->get();
	$allssd =  \App\Models\Order::whereBetween('date', [$from, $to])
	                         // ->where("payment_method", "Espèces")
	                         ->get();


return $products = \DB::table('orders')
    ->whereBetween('date', [$from, $to])
    ->selectRaw('count(*) as user_count, payment_method')
    ->selectRaw('SUM(pay_amount) as sum, payment_method')
    ->groupBy('payment_method')
    // ->groupBy('pay_amount')
    ->get();


	// return Session::flush('cart');
	// dd(session('cusTro'));
	dd(session('orderPart'));
	$isOf = session()->get('isOffer');

dd($isOf);

	if ($isOf == null) {
		dd('ce');
	}else{
		dd('mm');
	}

 dd(session('isOffer'));
		// $isOf = session()->get('isOffer');

	// return Session::flush('cart');
	// return Session::flush('isOffer');
if(session('isOffer') == null){

        dd(session('isOffer'));
        dd(session('cart'));
}else{
	dd('bak');
}

});




Route::get('map', function(){

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
		    return 0;
		  }
		  else {
		    $theta = $lon1 - $lon2;
		    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		    $dist = acos($dist);
		    $dist = rad2deg($dist);
		    $miles = $dist * 60 * 1.1515;
		    $unit = strtoupper($unit);

		    if ($unit == "K") {
		      return ($miles * 1.609344);
		    } else if ($unit == "N") {
		      return ($miles * 0.8684);
		    } else {
		      return $miles;
		    }
		  }
		}

echo distance(23.823313, 90.364562, 23.806509, 90.362719, "M") . " Miles<br>";
echo distance(23.823313, 90.364562, 23.806509, 90.362719, "K") . " Kilometers<br>";
$getUser =  intval(distance(23.823313, 90.364562, 23.806509, 90.362719, "K")) . " Kilometers<br>";



echo distance(23.823313, 90.364562, 23.806509, 90.362719, "N") . " Nautical Miles<br>";


});








Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route::get('/', function(){
// 	return view('front.index');
// });



Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/v1', [MainController::class, 'index1'])->name('index1');
Route::get('/review', [MainController::class, 'review'])->name("review.index");

Route::get('/about-us', [MainController::class, 'aboutUs'])->name("about.index");
Route::get('/contact-us', [MainController::class, 'contactUs'])->name("contact.index");
Route::get('/catering', [MainController::class, 'catering'])->name("catering.index");
Route::get('/home/categories', [MainController::class, 'menu'])->name("menu.index");
Route::get('/sub-category-view/{slug}', [MainController::class, 'subCatView'])->name("sub.cat");
// Route::get('/main-menu', function(){
// 	return view('welcome');
// });
Route::get('/main-menu', [MainController::class, 'mainMenu'])->name("mainMenu.index");

Route::get('/search', [MainController::class, 'searchProduct'])->name('searchProduct');

// custom url for category list product view and search result view

Route::get('/get-search-product/{data}', [MainController::class, 'cateList'])->name('cus.pro');

//contact page
Route::get('/our-restrurant', [MainController::class, 'contactPage']);



//single Category VIew

Route::get('/v-category/{slug}', [MainController::class, 'viewCategory']);

Route::get('/v-sub-category/{slug}', [MainController::class, 'viewSubCategory']);
///set menu items
Route::get('/setmenu-category', [MainController::class, 'setmenuCategory']);
Route::get('/set-v-category/{id}', [MainController::class, 'setCatView']);

//reservation
Route::get('/reservation', [MainController::class, 'reservation'])->name('reservation');
Route::post('/reservationSave', [MainController::class, 'reservationSave'])->name('reservation.save');

// caterer
Route::get('/caterer', [MainController::class, 'caterer']);
Route::post('/catererSave', [MainController::class, 'catererSave'])->name('caterer.save');

//cart controller
Route::get('/cart', [Cartcontroller::class, 'cartIndex'])->name("cart.index");
Route::middleware("auth")->post('/cart', [Cartcontroller::class, 'cartStore'])->name("cart.store");

// patment controller
Route::middleware("auth")->get('/checkout', [Checkoutcontroller::class, 'checkout'])->name("checkout.index");







Route::get('map', function(){

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
		    return 0;
		  }
		  else {
		    $theta = $lon1 - $lon2;
		    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		    $dist = acos($dist);
		    $dist = rad2deg($dist);
		    $miles = $dist * 60 * 1.1515;
		    $unit = strtoupper($unit);

		    if ($unit == "K") {
		      return ($miles * 1.609344);
		    } else if ($unit == "N") {
		      return ($miles * 0.8684);
		    } else {
		      return $miles;
		    }
		  }
		}

echo distance(23.823313, 90.364562, 23.806509, 90.362719, "M") . " Miles<br>";
echo distance(23.823313, 90.364562, 23.806509, 90.362719, "K") . " Kilometers<br>";
$getUser =  intval(distance(23.823313, 90.364562, 23.806509, 90.362719, "K")) . " Kilometers<br>";



echo distance(23.823313, 90.364562, 23.806509, 90.362719, "N") . " Nautical Miles<br>";


});








Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route::get('/', function(){
// 	return view('front.index');
// });



Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/v1', [MainController::class, 'index1'])->name('index1');
Route::get('/review', [MainController::class, 'review'])->name("review.index");

Route::get('/about-us', [MainController::class, 'aboutUs'])->name("about.index");
Route::get('/contact-us', [MainController::class, 'contactUs'])->name("contact.index");
Route::get('/catering', [MainController::class, 'catering'])->name("catering.index");
Route::get('/home/categories', [MainController::class, 'menu'])->name("menu.index");
Route::get('/sub-category-view/{slug}', [MainController::class, 'subCatView'])->name("sub.cat");
// Route::get('/main-menu', function(){
// 	return view('welcome');
// });
Route::get('/main-menu', [MainController::class, 'mainMenu'])->name("mainMenu.index");

Route::get('/search', [MainController::class, 'searchProduct'])->name('searchProduct');

// custom url for category list product view and search result view

Route::get('/get-search-product/{data}', [MainController::class, 'cateList'])->name('cus.pro');

//contact page
Route::get('/our-restrurant', [MainController::class, 'contactPage']);



//single Category VIew

Route::get('/v-category/{slug}', [MainController::class, 'viewCategory']);

Route::get('/v-sub-category/{slug}', [MainController::class, 'viewSubCategory']);
///set menu items
Route::get('/setmenu-category', [MainController::class, 'setmenuCategory']);
Route::get('/set-v-category/{id}', [MainController::class, 'setCatView']);

//reservation
Route::get('/reservation', [MainController::class, 'reservation'])->name('reservation');
Route::post('/reservationSave', [MainController::class, 'reservationSave'])->name('reservation.save');

// caterer
Route::get('/caterer', [MainController::class, 'caterer']);
Route::post('/catererSave', [MainController::class, 'catererSave'])->name('caterer.save');

//cart controller
Route::get('/cart', [Cartcontroller::class, 'cartIndex'])->name("cart.index");
Route::middleware("auth")->post('/cart', [Cartcontroller::class, 'cartStore'])->name("cart.store");

// patment controller
Route::middleware("auth")->get('/checkout', [Checkoutcontroller::class, 'checkout'])->name("checkout.index");

// Route::get('checkout', function(){
// 	dd('d');
// });


// Route::middleware("auth")->get('/checkout', [Checkoutcontroller::class, 'checkout'])->name("checkout.index");


Route::middleware("auth")->post('/checkout', [Checkoutcontroller::class, 'store'])->name("checkout.store");

Route::middleware("auth")->post('/payment/stripe/{order}', [Checkoutcontroller::class, 'paymentWithStripeStore'])->name("payment.store.stripe");
Route::middleware("auth")->get('/payment/stripe/{order}', [Checkoutcontroller::class, 'paymentWithStripeView'])->name("payment.index.stripe");

Route::middleware("auth")->post('/payment/paypal/{order}', [Checkoutcontroller::class, 'paymentWithPaypalStore'])->name("payment.store.paypal");
Route::middleware("auth")->get('/payment/paypal/{order}', [Checkoutcontroller::class, 'paymentWithPaypalView'])->name("payment.index.paypal");

Route::middleware("auth")->get('/payment/success', [Checkoutcontroller::class, 'success'])->name("payment.success");

// save order
Route::post('/saveOrder', [Checkoutcontroller::class, 'saveOrder'])->name('saveOrder');




Auth::routes();

Route::get('/home', function(){
	return redirect()->route('myAccount');
});
// Route::get('/login', function(){
// 	return redirect()->route('index');
// });

// Route::post('login', [ 'as' => 'login'], function(){
// 	return redirect()->route('index');
// });

Route::get('/sp', [App\Http\Controllers\HomeController::class, 'sp']);
Route::get('/order-details/{id}', [App\Http\Controllers\HomeController::class, 'orderDetails']);

Route::get('/my-account', [App\Http\Controllers\HomeController::class, 'myAccount'])->name('myAccount');
Route::post('/my-account-save', [App\Http\Controllers\HomeController::class, 'myInfoSave'])->name('my.info');
Route::post('/my-pass-save', [App\Http\Controllers\HomeController::class, 'myPassSave'])->name('my.pass');
Route::get('/my-address', [App\Http\Controllers\HomeController::class, 'myAddress'])->name('myAddress');
Route::post('/saveAddress', [App\Http\Controllers\HomeController::class, 'saveAddress'])->name('saveAddress');

Route::get('/my-order', [App\Http\Controllers\HomeController::class, 'myOrder'])->name('myOrder');
Route::post('/my-review', [App\Http\Controllers\HomeController::class, 'myReview'])->name('myReview');
Route::get('/get-discount/{id}', [App\Http\Controllers\HomeController::class, 'getDIscountPoint']);
Route::get('/getaVa/{id}', [App\Http\Controllers\HomeController::class, 'getaVa']);



		Route::get('/admin', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('login.admin');
Route::middleware("Admin")->group(function () {

		/// admin


		Route::post('/admin', [App\Http\Controllers\Admin\LoginController::class, 'login']);
	

		Route::middleware("Admin")->get('/admin/dashboard', [App\Http\Controllers\Admin\MainController::class, 'index']);

		Route::get('/admin/calendar', [App\Http\Controllers\Admin\MainController::class, 'calendarIndex'])->name('calendar');
		
		Route::get('/admin/point', [App\Http\Controllers\Admin\MainController::class, 'pointIndex'])->name('point');
		Route::post('/admin/pointSave', [App\Http\Controllers\Admin\MainController::class, 'pointSave'])->name('pointSave');
		Route::get('/admin/pointDelete/{id}', [App\Http\Controllers\Admin\MainController::class, 'pointDelete'])->name('pointDelete');
		
		Route::get('/admin/plsDelete/{id}', [App\Http\Controllers\Admin\MainController::class, 'plsDelete'])->name('plsDelete');
		Route::DELETE('/admin/point-delete-list/{id}', [App\Http\Controllers\Admin\MainController::class, 'pointDeletList'])->name('list.point');

		
		
		Route::post('/admin/pointlistSave', [App\Http\Controllers\Admin\MainController::class, 'pointlistSave'])->name('pointlistSave');
		
		Route::get('/admin/paymentInfo', [App\Http\Controllers\Admin\MainController::class, 'paymentInfo']);
		Route::post('/admin/paymentSave', [App\Http\Controllers\Admin\MainController::class, 'paymentSave']);

		//Coupon

		Route::get('/admin/coupon', [App\Http\Controllers\Admin\CouponController::class, 'coupon']);
		Route::post('/admin/couponStatus', [App\Http\Controllers\Admin\CouponController::class, 'couponStatus']);
		Route::DELETE('/admin/couponDelete/{id}', [App\Http\Controllers\Admin\CouponController::class, 'couponDelete']);


		//order 
		Route::get('/admin/order', [App\Http\Controllers\Admin\MainController::class, 'orderIndex']);
		Route::get('/admin/order-get-new', [App\Http\Controllers\Admin\MainController::class, 'orderGetNew']);
		Route::get('/admin/order-view/{id}', [App\Http\Controllers\Admin\MainController::class, 'orderView']);
		Route::get('/admin/getOrderTone', [App\Http\Controllers\Admin\MainController::class, 'getOrderTone']);
		Route::POST('/admin/OrderpaymentStatus', [App\Http\Controllers\Admin\MainController::class, 'OrderpaymentStatus']);

		Route::get('/admin/orderAccept/{id}', [App\Http\Controllers\Admin\MainController::class, 'orderAccept'])->name('orderAccept');
		Route::get('/admin/orderDelete/{id}', [App\Http\Controllers\Admin\MainController::class, 'orderDelete'])->name('orderDelete');
		Route::get('/admin/orderComplate/{id}', [App\Http\Controllers\Admin\MainController::class, 'orderComplate'])->name('orderComplate');
		//print
		Route::get('/admin/order-print/{id}', [App\Http\Controllers\Admin\MainController::class, 'orderPrint'])->name('orderPrint');


		Route::get('/admin/offer', [App\Http\Controllers\Admin\MainController::class, 'offerIdex']);
		Route::post('/admin/offerSave', [App\Http\Controllers\Admin\MainController::class, 'offerSave']);
		Route::DELETE('/admin/offerDelete/{id}', [App\Http\Controllers\Admin\MainController::class, 'offerDelete']);
		//reservations
		Route::get('/admin/reservation', [App\Http\Controllers\Admin\MainController::class, 'reservation']);
		Route::get('/admin/reservationshow/{id}', [App\Http\Controllers\Admin\MainController::class, 'reservationshow']);
		Route::post('/admin/reservationStatus', [App\Http\Controllers\Admin\MainController::class, 'reservationStatus']);

		//caterer
		Route::get('/admin/caterer', [App\Http\Controllers\Admin\MainController::class, 'caterer']);
		Route::get('/admin/catererShow/{id}', [App\Http\Controllers\Admin\MainController::class, 'catererShow']);
		Route::post('/admin/catererStatus', [App\Http\Controllers\Admin\MainController::class, 'catererStatus']);

		Route::get('/admin/shipping', [App\Http\Controllers\Admin\MainController::class, 'shippingIndex'])->name('shippingIndex');
		Route::POST('/admin/shippingSave', [App\Http\Controllers\Admin\MainController::class, 'shippingSave']);
		Route::POST('/admin/shippingEdit', [App\Http\Controllers\Admin\MainController::class, 'shippingEdit'])->name('edit.shipping');
		Route::get('/admin/shippingShow/{id}', [App\Http\Controllers\Admin\MainController::class, 'shippingShow'])->name('show.shipping');
		Route::DELETE('/admin/shippingDelete/{id}', [App\Http\Controllers\Admin\MainController::class, 'shippingDelete']);
		Route::post('/admin/status-shipping', [App\Http\Controllers\Admin\MainController::class, 'shippingStatus'])->name('status.shipping');
		//report

		Route::get('/admin/report', [App\Http\Controllers\Admin\MainController::class, 'reportIndex']);

		Route::get('/admin/details/day/{to}/{from}/{pMethods}', [App\Http\Controllers\Admin\MainController::class, 'reportDetails'])->name('report.details');





		Route::get('/admin/report-for-month', [App\Http\Controllers\Admin\MainController::class, 'reportMonth']);

		Route::get('/admin/report-for-day', [App\Http\Controllers\Admin\MainController::class, 'reportday']);

		Route::get('/admin/report-for-year', [App\Http\Controllers\Admin\MainController::class, 'reportYear']);
		Route::get('/admin/report-for-details/{id}/{date}', [App\Http\Controllers\Admin\MainController::class, 'reportSHowDetails']);
		Route::get('/admin/report-month/{id}/{month}', [App\Http\Controllers\Admin\MainController::class, 'reportSHowDetailsMonth']);

		// customer 

		Route::get('/admin/customer', [App\Http\Controllers\Admin\CustomController::class, 'customer']);


		// Route::resource('/category', [App\Http\Controllers\Admin\::class]);
		Route::resource('/admin/category', CategoryController::class);
		Route::post('/admin/promoteStatus', [App\Http\Controllers\Admin\CategoryController::class, 'promoteStatus']);

		Route::resource('/admin/sub-category', SubCategoryController::class);
		Route::post('/admin/subCatepromoteStatus', [App\Http\Controllers\Admin\SubCategoryController::class, 'subCatepromoteStatus']);

		//banner seation
		Route::resource('/admin/banner', BannerController::class);





		Route::resource('/admin/product', ProductController::class);
		Route::POST('/admin/PricePromoteStatus', [App\Http\Controllers\Admin\ProductController::class, 'PricePromoteStatus']);

		Route::get('/admin/product-option', [App\Http\Controllers\Admin\ProductController::class, 'productOption'])->name('pro.option');

		Route::get('/pro_title_delete/{id}', [ProductController::class, 'pro_title_delete'])->name('pro_title_delete');


		//sale

		Route::get('/admin/sale-view', [ProductController::class, 'saleView'])->name('sale.view');
		Route::get('/admin/sale-add/{id}', [ProductController::class, 'sale'])->name('sale');
		Route::POST('/admin/saleSave', [ProductController::class, 'saleSave'])->name('sale.save');
		Route::get('/admin/saleDelete/{id}', [ProductController::class, 'saleDelete'])->name('saleDelete');
		Route::post('/admin/salePromoteStatus', [ProductController::class, 'salePromoteStatus'])->name('salePromoteStatus');

		// Route::post('/admin/PricePromoteStatus', [ProductController::class, 'PricePromoteStatus'])->name('PricePromoteStatus');

		Route::post('/admin/proTitle', [App\Http\Controllers\Admin\ProductController::class, 'proTitle'])->name('proTitle');

		Route::get('/pro_title_edit/{id}', [ProductController::class, 'pro_title_edit'])->name('pro_title_edit');
		Route::post('/options-edit', [ProductController::class, 'optionsEdit'])->name('options.edit');



		Route::post('/get-options-store', [ProductController::class, 'getOptionStore'])->name('getOptionStore');

		Route::get('/options-delete/{id}', [ProductController::class, 'optionsDelete'])->name('options.delete');


		Route::POST('/admin/getSubCategory', [App\Http\Controllers\Admin\ProductController::class, 'getSubCategory']);

		/// rider create
		Route::resource('/admin/rider', RiderController::class);

		/// Profile create
		Route::get('/admin/profile', [App\Http\Controllers\Admin\MainController::class, 'profileIndex']);
		Route::post('/admin/change-password',[App\Http\Controllers\Admin\MainController::class, 'changePassword']);
		Route::post('/admin/change-info',[App\Http\Controllers\Admin\MainController::class, 'changeInfo']);

		//general control
		Route::get('/admin/general', [App\Http\Controllers\Admin\GeneralController::class, 'index']);
		Route::get('/admin/seo', [App\Http\Controllers\Admin\GeneralController::class, 'seo']);
		Route::post('/admin/seoSave', [App\Http\Controllers\Admin\GeneralController::class, 'seoSave']);
		// Route::get('/admin/shipping', [App\Http\Controllers\Admin\GeneralController::class, 'shipping']);
		
		
		Route::POST('/admin/generalSave', [App\Http\Controllers\Admin\GeneralController::class, 'genaralSave']);
        //Schedule
		Route::get('/admin/openSchedules', [App\Http\Controllers\Admin\MainController::class, 'scheduleIndex']);
			Route::post('/admin/openSchedulesSave', [App\Http\Controllers\Admin\MainController::class, 'openSchedulesSave']);
			Route::DELETE('/admin/openSchedulesDelete/{id}', [App\Http\Controllers\Admin\MainController::class, 'openSchedulesDelete']);
		
		
		//contact
		Route::get('/admin/contact', [App\Http\Controllers\Admin\GeneralController::class, 'genaralcontact']);
		Route::post('/admin/genaralcontactSAve', [App\Http\Controllers\Admin\GeneralController::class, 'genaralcontactSAve']);




		///set menu

		Route::get('/admin/setmenu', [App\Http\Controllers\Admin\SetMenuController::class, 'index']);
		Route::post('/admin/setmenuSave', [App\Http\Controllers\Admin\SetMenuController::class, 'setmenuSave'])->name('setmenu.store');
		Route::get('/admin/delete-setmenu/{id}', [App\Http\Controllers\Admin\SetMenuController::class, 'setmenuDelete'])->name('setmenu.delete');
		Route::get('/admin/show-setmenu/{id}', [App\Http\Controllers\Admin\SetMenuController::class, 'setmenuShow'])->name('setmenu.show');
		///set ment category
		Route::post('/admin/setmenu-category', [App\Http\Controllers\Admin\SetMenuController::class, 'setmenuCategorySAve'])->name('setmenuCategory.store');
		Route::get('/admin/setmenu-category-delete/{id}', [App\Http\Controllers\Admin\SetMenuController::class, 'setmenuCategoryDelete'])->name('setmenuCategory.delete');
		//setmenu product
		Route::post('/admin/setmenu-product', [App\Http\Controllers\Admin\SetMenuController::class, 'setmenuProduct'])->name('setmenuProduct.store');
		Route::get('/admin/setmenu-product-delete/{id}', [App\Http\Controllers\Admin\SetMenuController::class, 'setmenuProductDelete'])->name('setmenuProduct.delete');



		Route::get('/admin/about-page', [App\Http\Controllers\Admin\SettingController::class, 'aboutPage']);

		Route::post('/admin/aboutImageStore', [App\Http\Controllers\Admin\SettingController::class, 'aboutImageStore'])->name('aboutImageStore');



		Route::get('/admin/home-page', [App\Http\Controllers\Admin\SettingController::class, 'homePage'])->name('home.page');

		Route::post('/admin/homePageStore', [App\Http\Controllers\Admin\SettingController::class, 'homePageStore'])->name('homePageStore');





});



///Rider dashboard


Route::get('/rider', [App\Http\Controllers\Rider\LoginController::class, 'showLoginForm'])->name('login.rider');

Route::post('/rider', [App\Http\Controllers\Rider\LoginController::class, 'login']);

Route::get('/rider/dashboard', [App\Http\Controllers\Rider\MainController::class, 'index']);

//order 
Route::get('/rider/order', [App\Http\Controllers\Rider\MainController::class, 'orderIndex']);
Route::get('/rider/order-view/{id}', [App\Http\Controllers\Rider\MainController::class, 'orderView']);
Route::get('/rider/googleMap/{id}', [App\Http\Controllers\Rider\MainController::class, 'googleMap']);


Route::get('/rider/deliveryStatus/{id}', [App\Http\Controllers\Rider\MainController::class, 'deliveryStatus']);
/// Profile create
Route::get('/rider/profile', [App\Http\Controllers\Rider\MainController::class, 'profileIndex']);
Route::post('/rider/change-password',[App\Http\Controllers\Rider\MainController::class, 'changePassword']);
Route::post('/rider/change-info',[App\Http\Controllers\Rider\MainController::class, 'changeInfo']);


Route::get('/rider/getOrderToneRider', [App\Http\Controllers\Rider\MainController::class, 'getOrderToneRider']);



//password reset route

Route::get('reset-password', [App\Http\Controllers\MainController::class, 'resetIndex'])->name('pass.reset');
Route::get('varifyEmail', [App\Http\Controllers\MainController::class, 'varifyEmail'])->name('varifyEmail');
Route::get('varifyEmail-token/{value}', [App\Http\Controllers\MainController::class, 'varifyEmailToken'])->name('varifyEmailToken');
Route::post('varifyPassword-token', [App\Http\Controllers\MainController::class, 'varifyPassword'])->name('varifyPassword');


Route::get('/reB', function(){
	// return redirect(Redirect::intended()->getTargetUrl());
	// You can replace above line with the following to return to previous page
	return back();	// or return redirect()->back();
});