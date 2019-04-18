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
            'firstName' => encrypt('Joël'),
            'middleName' => null,
            'lastname' => encrypt('Rijfers'),
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
            'firstName' => encrypt('Ruben'),
            'middleName' => null,
            'lastName' => encrypt('Westermann'),
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
            'firstName' => encrypt('Bram'),
            'middleName' => null,
            'lastName' => encrypt('Dortmans'),
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
            'firstName' => encrypt('Bram'),
            'middleName' => null,
            'lastName' => encrypt('Vermeeren'),
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
            'firstName' => encrypt('Ayoub'),
            'middleName' => null,
            'lastName' => encrypt('Belali'),
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
            'firstName' => encrypt('Burak'),
            'middleName' => null,
            'lastName' => encrypt('Imre'),
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
            'firstName' => encrypt('Dogen'),
            'middleName' => encrypt('Arias'),
            'lastName' => encrypt('Maat'),
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
            'firstName' => encrypt('Jeroen'),
            'middleName' => encrypt('van'),
            'lastName' => encrypt('Beuningen'),
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
            'firstName' => encrypt('Martijn'),
            'middleName' => null,
            'lastName' => encrypt('Blom'),
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
            'firstName' => encrypt('Merijn'),
            'middleName' => null,
            'lastName' => encrypt('Monfils'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);
    }
}
