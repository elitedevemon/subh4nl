<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('order_method')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_zip')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_lo')->nullable();
            $table->string('customer_la')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('payment_status');
            $table->string('pay_amount');
            $table->string('txnid')->nullable();
            $table->string('totalQty');
            $table->string('payment_method');
            $table->string('time');
            $table->string('date');
            $table->string('status')->default(0);
            $table->string('deliveryStatus')->default(0);
            $table->string('pageView')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
