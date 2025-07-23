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
        $this->call([RoleTableSeeder::class]);
        $this->call([RestaurantSeeder::class]);
        $this->call([CategorySeeder::class]);
        $this->call([ReviewSeeder::class]);
        $this->call([BranchSeeder::class]);
        $this->call([FoodSeeder::class]);
        factory('App\Favourites', 10)->create();
        factory('App\Order', 10)->create();
        factory('App\Cart', 10)->create();
        factory('App\Address', 10)->create();
        factory('App\Cusine', 10)->create();
        // factory('App\Category', 10)->create();
        $this->call([UserTableSeeder::class]);

    }
}
