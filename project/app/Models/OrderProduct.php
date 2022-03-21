<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    function product(){
    	return $this->belongsTo(Product::class);
    }
    function setmenu(){
    	return $this->belongsTo(SetMenu::class, 'set_menu_id', 'id');
    }
}
