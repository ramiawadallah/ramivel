<?php

use Illuminate\Database\Seeder;

class LangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('langs')->insert(([
            'name'      =>  'English',
            'code'      =>  'en',
            'direction' =>  'ltr',
            'default'   =>  1,
        ]));
    }
}
