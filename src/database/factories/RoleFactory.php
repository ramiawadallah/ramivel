<?php

/* @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;

$factory->define(Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
