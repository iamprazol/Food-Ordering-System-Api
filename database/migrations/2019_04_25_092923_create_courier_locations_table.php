<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourierLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('courier_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('courier_id')->index();
            $table->decimal('lat',10,7);
            $table->decimal('lng',10,7);
            $table->decimal('heading',5,2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courier_locations');
    }
}
