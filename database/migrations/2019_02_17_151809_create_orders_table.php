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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('restaurant_id');
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('courier_id')->nullable()->index();
            $table->date('delivery_date');
            $table->time('delivery_time');
            $table->string('instruction')->nullable();
            $table->longText('details')->nullable();
            $table->float('total_price');
            $table->boolean('delivered')->default(0);
            $table->boolean('paid')->default(0);
            $table->string('status', 32)->index()->nullable();
            $table->string('payment_status', 32)->default('NONE');
            $table->timestamp('placed_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('otp_code', 6)->nullable();
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
