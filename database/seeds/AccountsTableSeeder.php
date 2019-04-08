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

        $filePath = public_path() . "/images/avatar_default.jpg";

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'joel@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Joël',
            'middleName' => null,
            'lastName' => 'Rijfers',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'ruben@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Ruben',
            'middleName' => null,
            'lastName' => 'Westerman',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'bramd@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Bram',
            'middleName' => null,
            'lastName' => 'Dortmans',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'bramv@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Bram',
            'middleName' => null,
            'lastName' => 'Vermeeren',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'ayoub@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Ayoub',
            'middleName' => null,
            'lastName' => 'Ik weet je achternaam niet',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'burak@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Burak',
            'middleName' => null,
            'lastName' => 'Imre',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'dogen@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Dogen',
            'middleName' => null,
            'lastName' => 'Arias Maat',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'jeroen@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Jeroen',
            'middleName' => null,
            'lastName' => 'van Beuningen',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'martijn@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Martijn',
            'middleName' => null,
            'lastName' => 'Blom',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'merijn@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => 'Merijn',
            'middleName' => null,
            'lastName' => 'Monfils',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);
    }
}
