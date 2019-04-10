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

        //Arrays need to be the same size!
        $numbers = array(100, 115, 150, 5, 1, 10, 142, 5, 9, 1, 153, 2);
        $additions = array("A", null, null, null, null, null, null, null, null, null, null, null);
        $codes = array("5211GL", "5223HH", "5237DE", "5301BE", "5342AJ", "6525GA", "5481AJ", "5282HK", "5268BZ", "9711ME", "2911RE", "3439MX");

        for($i = 0; $i < count($numbers); $i++){
            DB::table('locations')->insert([
                'houseNumber' => $numbers[$i],
                'houseNumberAddition' => $additions[$i],
                'postalCode' => $codes[$i],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
