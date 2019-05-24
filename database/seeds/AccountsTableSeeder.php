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
            'middleName' => encrypt(null),
            'lastname' => encrypt('Rijfers'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'ruben@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Ruben'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Westermann'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'bramd@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Bram'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Dortmans'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'bramv@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Bram'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Vermeeren'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'ayoub@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Ayoub'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Belali'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'burak@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Burak'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Imre'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
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
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'Admin',
            'gender' =>  'Male',
            'email' => 'jeroen@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Jeroen'),
            'middleName' => encrypt('van'),
            'lastName' => encrypt('Beuningen'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'martijn@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Martijn'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Blom'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60)
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'User',
            'gender' =>  'Male',
            'email' => 'merijn@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Merijn'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Monfils'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => bin2hex(openssl_random_pseudo_bytes(30))
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'Admin',
            'gender' =>  'Male',
            'email' => 'admin@yadu.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Admin'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Admin'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60),
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'Admin',
            'gender' =>  'Male',
            'email' => 'daannederlandse@gmail.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Daan'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Nederlandse'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60),
        ]);

        DB::table('accounts')->insert([
            'accountRole' => 'Admin',
            'gender' =>  'Male',
            'email' => 'lucaslatijnse@gmail.com',
            'password' => Hash::make('password'),
            'firstName' => encrypt('Lucas'),
            'middleName' => encrypt(null),
            'lastName' => encrypt('Latijnse'),
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'api_token' => str_random(60),
        ]);
    }
}
