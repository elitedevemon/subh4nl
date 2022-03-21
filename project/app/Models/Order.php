<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function orderlist()
    {
        return $this->hasMany(OrderList::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class,'code', 'customer_zip');
    }
}
