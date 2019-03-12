<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'status' => 'ongoing',
        'tag_id' => 1,
        'location_id' => '1',
        'owner_id' => '1',
        'eventName' => 'museum',
        'startDate' => date('Y-m-d H:i'),
        'endDate' => $faker->dateTimeBetween('now', '+1 month'),
        'numberOfPeople' => 1,
        'description' => $faker->text,
        'event_picture_id' => 1
    ];
});
