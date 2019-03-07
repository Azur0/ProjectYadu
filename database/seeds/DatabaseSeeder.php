<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\AccountRole')->create();
        factory('App\Location', 10)->create();
        factory('App\Gender')->create();
        factory('App\EventStatus')->create();
        factory('App\Account', 10)->create();
        factory('App\Event', 10)->create();
    }
}
