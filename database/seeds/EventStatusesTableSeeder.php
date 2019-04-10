<?php

use Illuminate\Database\Seeder;

class EventStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = array("Created", "Ongoing");

        foreach ($statuses as $status) {
            DB::table('event_statuses')->insert([
                'status' => $status,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
