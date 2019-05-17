<?php

use Illuminate\Database\Seeder;

class AccountHasFollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_has_followers')->insert([
            'account_id' => 1,
            'follower_id' => 2,
            'status' => 'accepted'
        ]);
        DB::table('account_has_followers')->insert([
            'account_id' => 3,
            'follower_id' => 4,
            'status' => 'accepted'
        ]);
    }
}
