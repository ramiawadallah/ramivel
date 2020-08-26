<?php

use Faker\Generator as Faker;
use App\Model\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
