<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
		'des',
		'image',
		'setmenu',
		'status'
    ];
    public function products()
    {
       return $this->hasMany('App\Models\Product')->where('status', 1)->where('sub_category_id', 0);
   
    }
     public function subcategory()
    {
       return $this->hasMany('App\Models\SubCategory');
   
    }
}
