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
            'id' => '1',
            'first_name' => 'Prajjwal',
            'last_name' => 'Poudel',
            'email' => 'iamprazol@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '984536256',
            'role_id' => 1
        ]);

        User::create([
            'id' => '2',
            'first_name' => 'kushal',
            'last_name' => 'poudel',
            'email' => 'ku@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '984536256',
            'role_id' => 2
        ]);

        User::create([
            'id' => '3',
            'first_name' => 'Sashank',
            'last_name' => 'Poudel',
            'email' => 'sasank@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '984516256',
            'role_id' => 2
        ]);

        User::create([
            'id' => '4',
            'first_name' => 'Bibita',
            'last_name' => 'Poudel',
            'email' => 'bibita@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '9845181246',
            'role_id' => 2
        ]);

        User::create([
            'id' => '5',
            'first_name' => 'Sushmita',
            'last_name' => 'Poudel',
            'email' => 'sushmita@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '9845181246',
            'role_id' => 2
        ]);
    }
}
