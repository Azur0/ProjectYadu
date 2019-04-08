<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory('App\Location', 10)->create();

        DB::table('locations')->insert([
            'houseNumber' => '100',
            'houseNumberAddition' => 'A',
            'postalCode' => '5211GL',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '115',
            'houseNumberAddition' => null,
            'postalCode' => '5223HH',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '150',
            'houseNumberAddition' => null,
            'postalCode' => '5237DE',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '5',
            'houseNumberAddition' => null,
            'postalCode' => '5301BE',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '1',
            'houseNumberAddition' => null,
            'postalCode' => '5342AJ',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '10',
            'houseNumberAddition' => null,
            'postalCode' => '6525GA',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '142',
            'houseNumberAddition' => null,
            'postalCode' => '5481AJ',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '5',
            'houseNumberAddition' => null,
            'postalCode' => '5282HK',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '9',
            'houseNumberAddition' => null,
            'postalCode' => '5268BZ',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('locations')->insert([
            'houseNumber' => '1',
            'houseNumberAddition' => null,
            'postalCode' => '9711ME',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
