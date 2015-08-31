<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $roles = array(
            ['name' => 'SUPER_ADMIN', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'ADMIN', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['name' => 'USER', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('roles')->insert($roles);
    }

}
