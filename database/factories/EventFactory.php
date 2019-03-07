<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'status' => 'ongoing',
        'location_id' => '1',
        'owner_id' => '1',
        'activityName' => 'museum',
        'startDate' => date('Y-m-d H:i'),
        'endDate' => $faker->dateTimeBetween('now', '+1 month'),
        'description' => $faker->text,
        'bannerImage' => $faker->imageUrl(1920, 1080, 'cats')
    ];
});
