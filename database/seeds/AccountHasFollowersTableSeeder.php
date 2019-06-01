<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'verification_string' => Str::random(32),
            'status' => 'accepted'
        ]);
        DB::table('account_has_followers')->insert([
            'account_id' => 3,
            'follower_id' => 4,
            'verification_string' => Str::random(32),
            'status' => 'pending'
        ]);
        DB::table('account_has_followers')->insert([
            'account_id' => 5,
            'follower_id' => 6,
            'verification_string' => Str::random(32),
            'status' => 'rejected'
        ]);
        DB::table('account_has_followers')->insert([
            'account_id' => 12,
            'follower_id' => 13,
            'verification_string' => Str::random(32),
            'status' => 'accepted'
        ]);
    }
}
