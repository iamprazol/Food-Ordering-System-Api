<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('restaurant_name');
            $table->integer('discount')->default(0);
            $table->integer('vat')->default(0);
            $table->integer('additional_charge')->default(0);
            $table->text('description');
            $table->time('delivery_from');
            $table->time('delivery_to');
            $table->float('minimum_order');
            $table->string('cover_pic')->default('cover.jpeg');
            $table->string('picture')->default('restaurant.jpeg');
            $table->string('address');
            $table->double('latitude')->default(27.23256);
            $table->double('longitude')->default(80.23256);
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
        Schema::dropIfExists('restaurnats');
    }
}
