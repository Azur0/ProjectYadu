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
        $numbers = array(52, 49, 158, 7, 11, 2, 41, 402, 105, 12, 5223, 19);
        $additions = array(null, null, null, "A", null, null, null, "B", null, null, null, null);
        $codes = array("5232NJ", "5241BK", "9752BN", "1791HJ", "8011BJ", "5473AX", "1017GB", "3059XT", "3012AG", "4811XK", "5223DJ", "5211JN");
        $lats = array(51.705940, 51.716360, 53.173160, 53.055630, 52.514050, 51.651180, 52.365370, 51.981740, 51.920460, 51.589000, 51.688549, 51.690190);
        $lons = array(5.319500, 5.356110, 6.603740, 4.796030, 6.086750, 5.467220, 4.885690, 4.581890, 4.479190, 4.778090, 5.287450, 5.301950);

        for($i = 0; $i < count($numbers); $i++){
            DB::table('locations')->insert([
                'houseNumber' => $numbers[$i],
                'houseNumberAddition' => $additions[$i],
                'postalCode' => $codes[$i],
                'locLongtitude' => $lons[$i],
                'locLatitude' => $lats[$i],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
