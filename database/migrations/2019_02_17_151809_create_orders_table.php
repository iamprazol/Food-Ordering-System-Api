<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('food_id');
            $table->integer('address_id');
            $table->string('quantity');
            $table->date('delivery_date');
            $table->time('delivery_time');
            $table->string('instruction')->nullable();
            $table->float('total_price');
            $table->boolean('delivered')->default(0);
            $table->boolean('paid')->default(0);
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
