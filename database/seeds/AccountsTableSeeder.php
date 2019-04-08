<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory('App\Account', 10)->create();

        //TODO capitalization
        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'joel@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Joël',
            'middleName' => null,
            'lastName' => 'Rijfers',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'ruben@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Ruben',
            'middleName' => null,
            'lastName' => 'Westerman',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'bramd@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Bram',
            'middleName' => null,
            'lastName' => 'Dortmans',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'bramv@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Bram',
            'middleName' => null,
            'lastName' => 'Vermeeren',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'ayoub@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Ayoub',
            'middleName' => null,
            'lastName' => 'Ik weet je achternaam niet',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'burak@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Burak',
            'middleName' => null,
            'lastName' => 'Imre',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'dogen@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Dogen',
            'middleName' => null,
            'lastName' => 'Arias Maat',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'jeroen@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Jeroen',
            'middleName' => null,
            'lastName' => 'van Beuningen',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'martijn@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Martijn',
            'middleName' => null,
            'lastName' => 'Blom',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'merijn@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Merijn',
            'middleName' => null,
            'lastName' => 'Monfils',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
