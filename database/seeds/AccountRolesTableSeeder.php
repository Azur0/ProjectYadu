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
        //factory('App\AccountRole')->create();
        DB::table('account_roles')->insert(['role' => 'user', 'description' => 'default role',]);
        DB::table('account_roles')->insert(['role' => 'admin', 'description' => 'administrator',]);
    }
}
