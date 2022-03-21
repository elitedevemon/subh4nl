<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catrens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nameOfEvent');
            $table->string('numberOfGuest');
            $table->string('email')->nullable();
            $table->string('number');
            $table->string('date');
            $table->string('time');
            $table->string('postcode');
            $table->string('place');
            $table->string('service');
            $table->string('budget');
            $table->string('society');
            $table->text('msg')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('catrens');
    }
}
