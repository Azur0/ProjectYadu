<?php

use Illuminate\Database\Seeder;

class ProhibitedWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //TODO realistic swearwords

        $words = array(
            "Kut",
            "Fuck",
            "Nigger",
            "Hoer",
            "Lul",
            "Piemel",
            "Tering",
            "Tiefus",
            "Kanker",
            "Aids",
            "Bitch",
            "Asshole",
            "Motherfucker",
            "Dick",
            "Cunt",
            "Whore",
            "Klootzak",
            "Mongool",
            "Slet",
            "Kutwijf",
            "tseries",
            "t-series",
        );

        foreach($words as $word) {
            DB::table('prohibited_words')->insert([
                'word' => $word,
            ]);
        }
    }
}
