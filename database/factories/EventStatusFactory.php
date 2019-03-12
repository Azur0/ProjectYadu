<?php

use Faker\Generator as Faker;

$factory->define(App\EventStatus::class, function (Faker $faker) {
    return [
        'status' => 'ongoing'
    ];
});
