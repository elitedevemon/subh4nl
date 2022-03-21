<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;
     protected $guarded = [];

     public function order()
    {
       return $this->belongsTo('App\Models\Order');

    }

     protected $casts = [
        'selectOption' => 'array',
        'g_paid' => 'array',
    ];
}
