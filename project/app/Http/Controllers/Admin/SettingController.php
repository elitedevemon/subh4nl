<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutImage;
use App\Models\HomePage;
use Image;
use Symfony\Component\Console\Input\Input;
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function aboutPage()
    {
        $aboutImage =  AboutImage::find(1);
        return view('admin.aboutPage', compact('aboutImage'));
    }
    public function homePage()
    {
    	 $homePage =  HomePage::find(1);
    	return view('admin.homePage', compact('homePage'));
    }

    public function homePageStore(Request $request)
    {
        $homePage = HomePage::find(1);
        $homePage->title = $request->title;
        $homePage->des = $request->des;

        if ($request->has('img1')) {
        $image=$request->file('img1');
        $imageName1 = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

        $post = Image::make($image)->resize(300,230)->save('storage/upload/aboutImage/'.$imageName1);

          $homePage->img1 = $imageName1;

        }

        if ($request->has('img2')) {
        $image=$request->file('img2');
        $imageName2 = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

        $post = Image::make($image)->resize(300,230)->save('storage/upload/aboutImage/'.$imageName2);

          $homePage->img2 = $imageName2;

        }

        if ($request->has('img3')) {
        $image=$request->file('img3');
        $imageName3 = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

        $post = Image::make($image)->resize(300,390)->save('storage/upload/aboutImage/'.$imageName3);

          $homePage->img3 = $imageName3;

        }


            $homePage->save();

            return back();












    }



    // public function aboutImageStore(Request $request)
    // {

    //     if ($request->has('img1')) {
    //       $image=$request->file('img1');
    //       $imageName = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

    //       $post = Image::make($image)->resize(268,200)->save('storage/upload/product/'.$imageName);

    //       $product->image = $imageName;

    //     }else {
    //         $product->image = "default.png";
    //     }


    // }
 //     function upload_image($path, $prefix, $storage_path, $width, $height){
	//   $extention = $path->getClientOriginalExtension();
	//   $filename = $prefix.'_' . date("jFYhis") . '.' . $extention;
	//   Image::make($path)->resize($width,$height)->save($storage_path.$filename);
	//   return $storage_path.$filename;
	// }

    // public function uploadImage($path, $storage_path, $width, $height)
    // {
    //     $image=$request->file('image');
    // }




    //     if($request->has('image')) {
    //       $image=$request->file('image');
    //       $imageName = 'product-'.'-'.time().'.'.$image->getClientOriginalExtension();

    //       $post = Image::make($image)->resize(268,200)->save('storage/upload/product/'.$imageName);

    //       $product->image = $imageName;

    //     }









}
