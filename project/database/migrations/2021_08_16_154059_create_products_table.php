<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
              $table->string('name');
              $table->string('slug');
            $table->foreignId('category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->string('image')->nullable();
            $table->string('dealImage')->nullable();
            $table->string('product_option')->nullable();
            $table->string('regular_price');
            $table->string('offer_price')->nullable();
            $table->string('is_offer_price')->default(0);
            $table->string('is_promo')->default(0);
            $table->string('is_deals')->default(0);
            $table->string('status')->default(1);
            $table->string('is_set')->default(0);
            $table->string('is_pro')->default(1);
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
        Schema::dropIfExists('products');
    }
}
