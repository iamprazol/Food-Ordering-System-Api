<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = [
            'id' => '1',
            'role' => 'admin',
        ];

        $r2 = [
            'id' => '2',
            'role' => 'restaurant',
        ];

        $r3 = [
            'id' => '3',
            'role' => 'delivery boy'
        ];

        $r4 = [
            'id' => '4',
            'role' => 'user'
        ];

        Role::create($r1);
        Role::create($r2);
        Role::create($r3);
        Role::create($r4);

        User::create([
            'id' => '11',
            'first_name' => 'kushal',
            'last_name' => 'poudel',
            'email' => 'ku@gmail.com',
            'password' => bcrypt('hello123'),
            'phone' => '984536256'
        ]);
    }
}
