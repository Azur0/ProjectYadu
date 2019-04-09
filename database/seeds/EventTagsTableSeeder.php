<?php

use Illuminate\Database\Seeder;

class EventTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory('App\EventTag')->create();

        $filePathDefault = public_path() . "/images/Seeder/EventTags/uitje_met_gezinnen.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/uitje_met_gezinnen_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Uitje met gezinnen',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/eten.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/eten_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Eten',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/borrelen.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/borrelen_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Borrelen',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/koffie.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/koffie_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Koffie',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/wandelen.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/wandelen_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Wandelen',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/uitje_in_stad.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/uitje_in_stad_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Uitje in stad',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/museum.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/museum_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Museum',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/theater_film.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/theater_film_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Theater/film',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/evenementen.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/evenementen_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Evenementen',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/van_alles_wat.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/van_alles_wat_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Van alles wat',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/sporten.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/sporten_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Sporten',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);

        $filePathDefault = public_path() . "/images/Seeder/EventTags/op_wielen.png";
        $filePathSelected = public_path() . "/images/Seeder/EventTags/op_wielen_1.png";

        DB::table('event_tags')->insert([
            'tag' => 'Op wielen',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'imageDefault' => fread(fopen($filePathDefault , "r"), filesize($filePathDefault)),
            'imageSelected' => fread(fopen($filePathSelected , "r"), filesize($filePathSelected))
        ]);
    }
}
