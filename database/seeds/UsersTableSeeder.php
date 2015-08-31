<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            ['email'=>'superadmin@ic.com', 'username' => 'superadmin', 'password' => Hash::make('superadmin'), 'active'=>1, 'roleId'=>1, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['email'=>'admin@ic.com', 'username' => 'admin', 'password' => Hash::make('admin'), 'active'=>1, 'roleId'=>2, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['email'=>'maxat@ic.com', 'username' => 'maxat', 'password' => Hash::make('maxatmaxat'), 'active'=>1, 'roleId'=>3, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('users')->insert($users);
    }

}
