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
            $table->integer('cusine_id');
            $table->string('restaurant_name');
            $table->integer('discount')->default(0);
            $table->integer('vat')->default(0);
            $table->integer('additional_charge')->default(0);
            $table->text('description');
            $table->string('delivery_hours');
            $table->float('minimum_order');
            $table->string('cover_pic');
            $table->string('picture');
            $table->string('address');
            $table->double('latitude');
            $table->double('longitude');
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
