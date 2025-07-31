<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $pictures = [
            'https://randomuser.me/api/portraits/men/11.jpg',
            'https://randomuser.me/api/portraits/women/12.jpg',
            'https://randomuser.me/api/portraits/men/13.jpg',
            'https://randomuser.me/api/portraits/women/14.jpg',
            'https://randomuser.me/api/portraits/men/15.jpg',
            'https://randomuser.me/api/portraits/women/16.jpg',
            'https://randomuser.me/api/portraits/men/17.jpg',
            'https://randomuser.me/api/portraits/women/18.jpg',
            'https://randomuser.me/api/portraits/men/19.jpg',
            'https://randomuser.me/api/portraits/women/20.jpg'
        ];

         DB::table('users')->insert([
                'role_id' => '1',
                'first_name' => "prajjwal",
                'last_name' => 'poudel',
                'email' => 'iamprazol@gmail.com',
                'password' => bcrypt('secret'), // default password
                'phone' => $faker->numerify('98########'),
                'picture' => $pictures[array_rand($pictures)],
                'remember_token' => str_random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);

        foreach (range(1, 20) as $index) {
            DB::table('users')->insert([
                'role_id' => $faker->numberBetween(1, 4),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('secret'), // default password
                'phone' => $faker->numerify('98########'),
                'picture' => $pictures[array_rand($pictures)],
                'remember_token' => str_random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
