<?php

use Illuminate\Database\Seeder;

class UploadsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('uploads')->delete();

        $uploads = array(
            ['userId'=>3, 'state'=>'0-0-0-0-0-0-0-0-0-0', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('uploads')->insert($uploads);
    }

}
