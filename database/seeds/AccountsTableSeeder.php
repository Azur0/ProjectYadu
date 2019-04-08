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

        DB::table('accounts')->insert([
            'accountRole' => 'user',
            'gender' =>  'male',
            'email' => 'joel@yadu.com',
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
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
            'password' => '2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'firstName' => 'Merijn',
            'middleName' => null,
            'lastName' => 'Monfils',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
