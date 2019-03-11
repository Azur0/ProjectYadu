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
        factory('App\EventTag')->create();
    }
}
