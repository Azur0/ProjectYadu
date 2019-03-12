<?php

use Faker\Generator as Faker;

$factory->define(App\AccountRole::class, function (Faker $faker) {
    return [
        'role' => 'user',
        'description' => 'default role'
    ];
});
