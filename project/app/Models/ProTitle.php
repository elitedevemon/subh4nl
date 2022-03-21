<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProTitle extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function productOption()
    {
       return $this->hasMany('App\Models\ProductOption');
    }
}
