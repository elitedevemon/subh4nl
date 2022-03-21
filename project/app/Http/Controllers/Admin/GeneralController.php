<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setting;
use App\Models\OurPage;
use Image;
class GeneralController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }
     public function index()
    {
      // return ();

    	 $setting = setting::findOrFail(1);
    	return view('admin.general.index', compact('setting'));
    }

    public function genaralSave(Request $request)
    {

      // return $request->all();
    	    $setting = setting::findOrFail(1);
    	 	$setting->title = $request->title;
    	 	$setting->email = $request->email;
    	 	$setting->phone = $request->phone;
        $setting->footer = $request->footer;
        $setting->limit_max = $request->limit_max;
    	 	$setting->limit_min = $request->limit_min;
    	 	$setting->promoTxt = $request->promoTxt;
    	 	$setting->fb = $request->fb;
    	 	$setting->insta = $request->insta;
    	 	$setting->twitter = $request->twitter;
    	 	$setting->address = $request->address;
        $setting->schedules = $request->schedules;
        $setting->select_timeOp = $request->select_timeOp;
        $setting->buy_offer = $request->buy_offer;
        $setting->discount = $request->discount;
        $setting->is_home = $request->is_home;
        $setting->is_delivery = $request->is_delivery;
        $setting->offer_limit = $request->offer_limit;
        $setting->is_offer1 = $request->is_offer1;
        $setting->is_offer2 = $request->is_offer2;
        $setting->re_offer = $request->re_offer;

    	 	 $setting->stripe_sc = $request->stripe_sc;
    	 	$setting->stripe_key = $request->stripe_key;



    	  if ($request->has('logo')) {
            $image=$request->file('logo');
          $imageName = 'logo'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(200,100)->save('storage/upload/logo/'.$imageName);

          $setting->logo = $imageName;


          }else {
              $setting->logo = $setting->logo;
          }

          if ($request->has('is_menu')) {
            $image=$request->file('is_menu');
            $imageNameIs = 'is_menu1'.'-'.time().'.'.$image->getClientOriginalExtension();

            $path = 'storage/upload/logo/';
            $image->move($path, $imageNameIs);
            $setting->is_menu = $imageNameIs;
          }else {
              $setting->is_menu = $setting->is_menu;
          }
          if ($request->has('is_menu_eng')) {
            $image=$request->file('is_menu_eng');
            $imageNameIs = 'is_menu_eng1'.'-'.time().'.'.$image->getClientOriginalExtension();

            $path = 'storage/upload/logo/';
            $image->move($path, $imageNameIs);
            $setting->is_menu_eng = $imageNameIs;
          }else {
              $setting->is_menu_eng = $setting->is_menu_eng;
          }


          if ($request->has('img_re')) {
            $image=$request->file('img_re');
          $imageNameRe = 'img_re'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(351,340)->save('storage/upload/logo/'.$imageNameRe);

          $setting->img_re = $imageNameRe;


          }else {
              $setting->img_re = $setting->img_re;
          }




	         if ($request->has('favicon')) {
            $image=$request->file('favicon');
          $imageName = 'favicon'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->save('storage/upload/logo/'.$imageName);

          $setting->favicon = $imageName;

	        }else {
	            $setting->favicon = $setting->favicon;
	        }

	        // if ($request->has('footerlogo')) {
         //    $image=$request->file('footerlogo');
         //  $imageName = 'footerlogo'.'-'.time().'.'.$image->getClientOriginalExtension();

         //  $post = Image::make($image)->resize(200,100)->save('storage/upload/logo/'.$imageName);

         //  $setting->footerlogo = $imageName;

	        // }else {
	        //     $setting->footerlogo = $setting->footerlogo;
	        // }
	        
          // if ($request->has('promo_image')) {
          // $image=$request->file('promo_image');
          // $imageName23 = 'logo'.'-'.time().'.'.$image->getClientOriginalExtension();

          // $post = Image::make($image)->resize(728,90)->save('storage/upload/logo/'.$imageName23);

          // $setting->promo_image = $imageName23;

          // }else {
          //     $setting->promo_image = $setting->promo_image;
          // }

          if ($request->has('promoImgAlert')) {
              $image=$request->file('promoImgAlert');
              $imageName = 'promo'.'-'.time().'.'.$image->getClientOriginalExtension();

              $post = Image::make($image)->resize(798,300)->save('storage/upload/logo/'.$imageName);

              $setting->promoImgAlert = $imageName;

          }else {
              $setting->promoImgAlert = $setting->promoImgAlert;
          }

          if ($request->has('banner1')) {
              $image=$request->file('banner1');
              $imageName = 'promo'.'-'.time().'.'.$image->getClientOriginalExtension();

              $post = Image::make($image)->resize(700,250)->save('storage/upload/logo/'.$imageName);

              $setting->banner1 = $imageName;

          }else {
              $setting->banner1 = $setting->banner1;
          }

          if ($request->has('banner2')) {
              $image=$request->file('banner2');
              $imageName = 'promo'.'-'.time().'.'.$image->getClientOriginalExtension();

              $post = Image::make($image)->resize(700,250)->save('storage/upload/logo/'.$imageName);

              $setting->banner2 = $imageName;

          }else {
              $setting->banner2 = $setting->banner2;
          }


    	 	$setting->save();
    	   return back();
    }


    public function genaralcontact()
    {
      $ourPage = OurPage::findOrFail(1);
      return view('admin.general.ourPage', compact('ourPage'));
    }
    public function genaralcontactSAve(Request $request)
    {
      // return $request->all();

      // return $request->des;

       $setting = OurPage::findOrFail(1);
        $setting->des = $request->des;
  

        if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'contact'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(800,550)->save('storage/upload/logo/'.$imageName);

          $setting->image = $imageName;

          }else {
              $setting->image = $setting->image;
          }


        $setting->save();
         return back();
    }

    public function seo()
    {
       $setting = setting::findOrFail(1);
      return view('admin.seo', compact('setting'));
    }

    public function seoSave(Request $request)
    {
      $setting = setting::findOrFail(1);
      $setting->metaTag = $request->metaTag;
      $setting->footer_part = $request->footer_part;
      $setting->save();
      return back()->with('status', 'Data Updated');
    }


    public function sendMailUser(Request $request)
    {
      $id = $request->reserID;
      $user= \App\Models\User::find($id);
      if ($request->has('img')) {
          $image = $request->file('img');
          $imageName = 'EMail'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(400,250)->save('storage/upload/banner/'.$imageName);
        }
          $details = [
                      'title' => 'Mail from Jardin de Kashmir',
                      'body' => $request->body,
                      'priority' => 'This is for testing email using smtp',
                      'from' => 'from',
                      'sender' => 'Jardin de Kashmir',
                      'to' => 'to',
                      'cc' => 'cc',
                      'bcc' => 'bcc',
                      'replyTo' => 'replyTo',
                      'subject' => 'subject',
                      'attc' => 'storage/upload/banner/'.$imageName,
                  ];

        //dynamic email need

                  \Mail::to([$user->email])->send(new \App\Mail\MyTestMail($details));
                  // dd("Email is Sent.");
                  return back();
    }



}
