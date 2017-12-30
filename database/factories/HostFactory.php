<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Host::class, function (Faker $faker) {
    return [
        'name' => $faker->citySuffix,
        'ip' => $faker->ipv4,
        'port' => mt_rand(60, 65535),
        'verify_code' => $faker->sha256
    ];
});
