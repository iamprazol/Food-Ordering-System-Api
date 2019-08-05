<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '11',
            'first_name' => 'kushal',
            'last_name' => 'poudel',
            'email' => 'ku@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '984536256',
            'role_id' => 2
        ]);

        User::create([
            'id' => '12',
            'first_name' => 'Prajjwal',
            'last_name' => 'Poudel',
            'email' => 'iamprazol@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '984536256',
            'role_id' => 2
        ]);

    }
}
