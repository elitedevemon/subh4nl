<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
   protected $guarded = [];
    public function subcategory()
    {
       return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');

    }
     public function category()
    {
       return $this->belongsTo('App\Models\Category')->where('status', 1);

    }
     public function saleP()
    {
       return $this->hasMany(Sale::class);
    }

    public function productAtrr()
    {
       return $this->hasMany('App\Models\ProductList', 'product_id', 'id');
    }
    public function productAtr()
    {
       return $this->hasMany('App\Models\ProductAttr', 'product_id', 'id');
    }
    protected $casts = [
        'product_option' => 'array'
    ];
}
