<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO descriptions
        //TODO images

        //factory('App\Event', 10)->create();
        $date = date("Y-m-d H:i:s");

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 1,
            'location_id' => 1,
            'owner_id' => 1,
            'event_picture_id' => 1,
            'eventName' => 'Met zijn alle naar het zwembad',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 2,
            'location_id' => 2,
            'owner_id' => 2,
            'event_picture_id' => 2,
            'eventName' => 'Onbeperkt tapas eten!',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 3,
            'location_id' => 3,
            'owner_id' => 3,
            'event_picture_id' => 3,
            'eventName' => 'Zaterdag biertje doen?',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 4,
            'location_id' => 4,
            'owner_id' => 4,
            'event_picture_id' => 4,
            'eventName' => 'Koffie in het buurthuis',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 5,
            'location_id' => 5,
            'owner_id' => 5,
            'event_picture_id' => 5,
            'eventName' => 'Wandelen in het bos',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 6,
            'location_id' => 6,
            'owner_id' => 6,
            'event_picture_id' => 6,
            'eventName' => 'Gezellig samen koopjes jagen',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 7,
            'location_id' => 7,
            'owner_id' => 7,
            'event_picture_id' => 7,
            'eventName' => 'Naar het oorlogsmuseum',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 8,
            'location_id' => 8,
            'owner_id' => 8,
            'event_picture_id' => 8,
            'eventName' => 'Film marthon met popcorn!',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 9,
            'location_id' => 9,
            'owner_id' => 9,
            'event_picture_id' => 9,
            'eventName' => 'Tweakers security meetup',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 10,
            'location_id' => 10,
            'owner_id' => 10,
            'event_picture_id' => 10,
            'eventName' => 'Nieuwe drone testen in het park',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 11,
            'location_id' => 11,
            'owner_id' => 1,
            'event_picture_id' => 11,
            'eventName' => 'Nieuwe drone testen in het park',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'status' => 'Created',
            'tag_id' => 12,
            'location_id' => 12,
            'owner_id' => 1,
            'event_picture_id' => 12,
            'eventName' => 'Nieuwe drone testen in het park',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'endDate' => date('Y-m-d', strtotime($date. ' + 11 days')),
            'numberOfPeople' => 5,
            'description' => 'Hello!',
            'isDeleted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

    }
}
