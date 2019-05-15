<?php

use Illuminate\Database\Seeder;

class AccountSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([

            'created_at' => date("Y-m-d H:i:s"),

        ]);
    }
}
