<?php

use Illuminate\Database\Seeder;

class EventPicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\EventPicture')->create();
    }
}