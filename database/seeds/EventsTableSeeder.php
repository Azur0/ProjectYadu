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
        //factory('App\Event', 10)->create();
        $date = date("Y-m-d H:i:s");

        DB::table('events')->insert([
            'tag_id' => 1,
            'location_id' => 1,
            'owner_id' => 1,
            'event_picture_id' => 14,
            'eventName' => 'Met zijn alle naar het zwembad',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 10,
            'description' => 'Wie gaat er mee naar het zwembad in den bosch? We gaan heel de middag zwemmen en daarna een patatje eten.',
            'isDeleted' => 0,
            'isHighlighted' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 2,
            'location_id' => 2,
            'owner_id' => 2,
            'event_picture_id' => 27,
            'eventName' => 'Onbeperkt tapas eten!',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 5,
            'description' => 'Onbeperkt tapas eten. Er is weer een actie bij La Cubanita, wie heeft er zin om mee te gaan?',
            'isDeleted' => 0,
            'isHighlighted' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 3,
            'location_id' => 3,
            'owner_id' => 3,
            'event_picture_id' => 33,
            'eventName' => 'Zaterdag biertje doen?',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 25,
            'description' => 'Ook deze week is iedereen weer uitgenodigd voor de wekelijkse borrel!',
            'isDeleted' => 0,
            'isHighlighted' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 4,
            'location_id' => 4,
            'owner_id' => 4,
            'event_picture_id' => 52,
            'eventName' => 'Koffie in het buurthuis',
            'startDate' => date('Y-m-d', strtotime($date. ' - 10 days')),
            'numberOfPeople' => 5,
            'description' => 'Alle mensen uit het dorp zijn van harte welkom om \'s middags op de koffie te komen om even bij te praten in het buurthuis.',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 5,
            'location_id' => 5,
            'owner_id' => 5,
            'event_picture_id' => 59,
            'eventName' => 'Wandelen in het bos',
            'startDate' => date('Y-m-d', strtotime($date. ' - 10 days')),
            'numberOfPeople' => 4,
            'description' => 'Ik ga volgende week wandelen in het bos in Zwolle. Als iemand het leuk vind om mee te gaan kom dan gerust mee.',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 6,
            'location_id' => 6,
            'owner_id' => 6,
            'event_picture_id' => 80,
            'eventName' => 'Gezellig samen koopjes jagen',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 2,
            'description' => 'Het is weer bijna koopavond en ik heb dringend nieuwe broeken nodig, maar het is wel zo gezellig om samen te gaan shoppen. Wie gaat er mee?',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 7,
            'location_id' => 7,
            'owner_id' => 7,
            'event_picture_id' => 90,
            'eventName' => 'Naar het oorlogsmuseum',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 4,
            'description' => 'Ik heb nog 4 vrijkaartjes voor het oorlogsmuseum in Amsterdam. Heeft iemand zin om mee te gaan?',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 8,
            'location_id' => 8,
            'owner_id' => 8,
            'event_picture_id' => 106,
            'eventName' => 'Film marthon met popcorn!',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 5,
            'description' => 'Ik had zin om een filmpje te pakken, maar ik weet nog niet welke. Meldt je vooral aan en als je nog een leuke film weet laat het even weten.',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 9,
            'location_id' => 9,
            'owner_id' => 9,
            'event_picture_id' => 136,
            'eventName' => 'Tweakers security meetup',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 3,
            'description' => 'De jaarlijkse tweakers security meetup is er weer, maar ik zoek nog een paar mensen die met mij mee willen gaan.',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 10,
            'location_id' => 10,
            'owner_id' => 10,
            'event_picture_id' => 145,
            'eventName' => 'Nieuwe drone testen in het park',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 2,
            'description' => 'Ik heb een nieuwe drone gekocht, maar heb er niet zo veel verstand van. Vind iemand het leuk om mij te helpen met uitzoeken hoe het werkt?',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 11,
            'location_id' => 11,
            'owner_id' => 1,
            'event_picture_id' => 163,
            'eventName' => 'Tafeltennis avond',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 4,
            'description' => 'Ik organiseer een tafeltennis avond bij mij thuis. Voor eten en drinken word gezorgd!',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('events')->insert([
            'tag_id' => 12,
            'location_id' => 12,
            'owner_id' => 1,
            'event_picture_id' => 185,
            'eventName' => 'Skateboarden in het park',
            'startDate' => date('Y-m-d', strtotime($date. ' + 10 days')),
            'numberOfPeople' => 20,
            'description' => 'Het is weer lekker weer dus we gaan lekker een dagje skaten in het park. Wie komt er ook?',
            'isDeleted' => 0,
            'isHighlighted' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
