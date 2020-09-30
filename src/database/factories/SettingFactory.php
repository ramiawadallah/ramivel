<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        //
        'title' => 'Ramivel',
        'subtitle' => 'Ramivel CMS',
        'email' => 'rami.moh.awadallah@gmail.com',
        'phone' => null,
        'address' => null,
        'fax' => null,
        'pobox' => '11118',
        'map' => null,
        'mainvideo' => null,
        // About your website
        'content' => null,
        'logo' => null,
        'icon' => null,
        'maintenance' => null,
        'keywords' => null,
        'copyright' => null,
        // Social media
        'facebook' => null,
        'twitter' => null,
        'instagram' => null,
        'linkedin' => null,
        'youtube' => null,

        'theme' => 'modern',

        'updated_by' => 'admin'
    ];
});
