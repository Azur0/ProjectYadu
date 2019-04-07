<?php

use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = array("Male", "Female");

        foreach ($genders as $gender) {
            DB::table('genders')->insert([
                'gender' => $gender,
            ]);
        }
    }
}
