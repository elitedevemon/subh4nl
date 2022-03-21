<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetMenu;
use App\Models\SetmenuCategory;
use App\Models\SetmenuProduct;
use Image;
class SetMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$getData = SetMenu::where('status', 1)->get();
    	return view('admin.setmenu.index', compact('getData'));
    }
    public function setmenuSave(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required',
            'des' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
          
        ]);
        
        $category = new SetMenu();
        $category->name = $request->name;
        $category->des = $request->des;
        $category->price = $request->price;


         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(200,200)->save('storage/upload/setmenu/'.$imageName);

          $category->image = $imageName;

        }else {
            $category->image = "default.png";
        }
        $category->save();
         return back()->with('status', 'Your SetMenu Category Add Successfully');
    	
    }

    public function setmenuDelete($id)
    {
    	$getData = SetMenu::find($id)->update([
    		'status' => 0
    	]);
    	return back()->with('status', 'Your SetMenu Category Deleted Successfully');
    } 


     public function setmenuShow($id)
    {
    	$setmenuCategory = SetmenuCategory::where('set_menu_id', $id)->where('status', 1)->get();
    	$setmenuCategoryProduct = SetmenuProduct::where('setmenu_category_id', $id)->where('status', 1)->get();
    	// $SetmenuProduct = SetmenuProduct::where('status', 1)->get();
    	return view('admin.setmenu.subSetMenu', compact('id','setmenuCategory','setmenuCategoryProduct'));
    } 

    public function setmenuCategorySAve(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required'
          
        ]);
        
        $category = new SetmenuCategory();
        $category->name = $request->name;
        $category->set_menu_id = $request->set_menu_id;
        $category->save();
         return back()->with('status', 'Your SetMenu Category Add Successfully');
    }


    public function setmenuCategoryDelete($id)
    {
    	$getData = SetmenuCategory::find($id)->update([
    		'status' => 0
    	]);
    	return back()->with('status', 'Your SetMenu Category Deleted Successfully');
    }

    /// set menu product 
     public function setmenuProduct(Request $request)
    {
    	$this->validate($request,[
            'name' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048'

          
        ]);
        
        $category = new SetmenuProduct();
        $category->name = $request->name;
        $category->setmenu_category_id = $request->setmenu_category_id;
         if ($request->has('image')) {
            $image=$request->file('image');
          $imageName = 'category'.'-'.time().'.'.$image->getClientOriginalExtension();

          $post = Image::make($image)->resize(200,200)->save('storage/upload/setmenu/'.$imageName);

          $category->image = $imageName;

        }else {
            $category->image = "default.png";
        }
        $category->save();
         return back()->with('status', 'Your SetMenu product Add Successfully');
    }

       public function setmenuProductDelete($id)
    {

    	$getData = SetmenuProduct::findOrFail($id);
    	$getData->delete();
    	return back()->with('status', 'Your SetMenu Product Deleted Successfully');
    }

    
}
