<?php

use Illuminate\Database\Seeder;

class AccountRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\AccountRole')->create();
    }
}
