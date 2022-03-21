<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
               $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('footerlogo')->nullable();
            $table->string('title')->nullable();
            $table->text('metaTag')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('footer')->nullable();
            $table->string('map_key')->nullable();
            $table->string('fb')->nullable();
            $table->string('insta')->nullable();
            $table->string('twitter')->nullable();
            $table->text('address')->nullable();
            $table->text('schedules')->nullable();
            $table->string('paypal_check')->nullable();
            $table->string('paypal_business')->nullable();
            $table->string('stripe_key')->nullable();
            $table->string('stripe_sc')->nullable();
            $table->string('gmap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
