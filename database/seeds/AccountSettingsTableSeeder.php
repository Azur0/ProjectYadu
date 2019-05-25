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

        for($i=1;$i<=13;$i++){
            DB::table('account_settings')->insert([
                'account_id' => $i,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
