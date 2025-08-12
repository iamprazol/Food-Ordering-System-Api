<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Manager;

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
            'role' => 'manager',
        ];

        $r3 = [
            'id' => '3',
            'role' => 'delivery'
        ];

        $r4 = [
            'id' => '4',
            'role' => 'user'
        ];

        Role::create($r1);
        Role::create($r2);
        Role::create($r3);
        Role::create($r4);

    }
}
