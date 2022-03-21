<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;
     protected $fillable = ['logo',
							'promoImgAlert',
							'is_accept_order',
							'promoTxt',
							'favicon',
							'footerlogo',
							'title',
							'metaTag',
							'email',
							'phone',
							'footer',
							'map_key',
							'fb',
							'insta',
							'twitter',
							'address',
							'schedules',
							'paypal_check',
							'paypal_business',
							'stripe_key',
							'stripe_sc',
							'gmap'];
}
