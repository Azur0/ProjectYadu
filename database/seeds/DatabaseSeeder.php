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

        $this->call(AccountRolesTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(EventTagsTableSeeder::class);
        $this->call(EventPicturesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(ProhibitedWordsTableSeeder::class);
        $this->call(SocialmediaTableSeeder::class);
    }
}
