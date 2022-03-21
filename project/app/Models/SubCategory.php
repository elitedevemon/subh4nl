<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function products()
    {
       return $this->hasMany('App\Models\Product')->where('status', 1);
    }

    public function category()
    {
       return $this->belongsTo('App\Models\Category');
    }
}
