<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
        	'id'                => '1',
             // website contact information
            'email'             => 'rami.moh.awadallah@gmail.com ',
            'phone'             => '+ 962 7 9896 1076', 
            'address'           => 'Amman 11195, Jordan Mecca Street',
            'fax'               => '+ 962 7 9896 1076',
            'pobox'             => '11111',
            'map'               => 'https://www.google.jo/maps/@31.8357604,35.9476308,10z?hl=en',
            'mainvideo'         => 'https://www.youtube.com',

            // About your website   
            
            'title'         	=> 'boomvel',
            'subtitle'      	=> 'boomvel',
            'content'           => 'boomvel',
            'copyright'         => 'Boomvel 2019',
            'keywords'          => 'Admin Panel, Laravel, CMS, Multiauth, Multilanguage',
            
            'maintenance'       => 'open',

            // Photo Logo for Home page website
            'logo'              => '',
            
            // Social media 
            'facebook'          => 'https://www.facebook.com',
            'twitter'           => 'https://www.twitter.com',
            'instagram'         => 'https://www.instagram.com',
            'linkedin'          => 'https://www.linkedin.com',
            'youtube'           => 'https://www.youtube.com',
        ]);
    }
}
