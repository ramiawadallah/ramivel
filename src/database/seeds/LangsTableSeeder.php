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

         \Control::store(request(),'langs',[
            'name'      =>  'English',
            'code'      =>  'en',
            'direction' =>  'ltr',
            'default'   =>  1,
        ]);
    }
}
