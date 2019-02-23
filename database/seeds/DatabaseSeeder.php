<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 10)->create();
        factory('App\Restaurant', 10)->create();
        factory('App\Review', 10)->create();
        factory('App\Branch', 10)->create();
        factory('App\Favourites', 10)->create();
        factory('App\Food', 10)->create();
        factory('App\Order', 10)->create();
        factory('App\Cart', 10)->create();
        factory('App\Address', 10)->create();
        factory('App\Cusine', 10)->create();
    }
}
