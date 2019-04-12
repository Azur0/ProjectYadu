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
            'firstName' => 'eyJpdiI6IlJnKzFQdjNOSHpnV3U5R0NrSWZqbUE9PSIsInZhbHVlIjoiem9DTmkraUNyR3lySVJxYTBFa2o4dz09IiwibWFjIjoiNWUyNWU2NmQyYTY4MzVkNmY2NTA0M2FiNTcxY2FkMTAxYWE4MDdlMGEyNmM0NDk3YmM1MmI4OTg4ZjdjYTg1MCJ9',
            'middleName' => null,
            'lastName' => 'eyJpdiI6ImNRTEVHNFBCVlN6Q1gwY1ErRmczcmc9PSIsInZhbHVlIjoiNjlidit4VW5SMHppNm9lK3E3TDhJUT09IiwibWFjIjoiMTkxZWFiNjlhYjQ2ODAyNzE0NzY5ZGU4ZmQ0NDNlNTE3YWE0OTRhZmIwNjM2NmNkMzdlMjc2OGMyNTIxMjNlMCJ9',
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
            'firstName' => 'eyJpdiI6Iml6XC9WOHozcnFDYlJFZ2lFSnB6YlVnPT0iLCJ2YWx1ZSI6InFrd1wvV3ZIeFNtM0daN05mZk5TRmdnPT0iLCJtYWMiOiIzNjdiN2U2NTRhN2ViMzFhNDcwNTZlZjViOWJiYmE0MjFkYTg1Y2Y4MGE0OTdkMDQ2MjAwMTkxOTRhNThmY2Q3In0=',
            'middleName' => null,
            'lastName' => 'eyJpdiI6ImhcL044dHhMU2ZxY1wvd2V6cWh5NDJhUT09IiwidmFsdWUiOiJ1aUxmRmM3OW1wRHVvWWJ2bGlDcmU0OEZldFwvSnYyZmtETVg3WUJxTVE2az0iLCJtYWMiOiI4ZGFmOGRiMTJjZDQ1NjM5NzZiZjVmY2YxMmI1MDNhMDhmMDFmZWMzMDQ4ZjJkNDk4N2JiYTA1NWRjZDBkNTc3In0=',
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
            'firstName' => 'eyJpdiI6InpsT0R1QjUxQ1NYWXhiVGNyMHBvXC9nPT0iLCJ2YWx1ZSI6IkJQY0pSY1FlUGllVVdjY0ZZYWl0clE9PSIsIm1hYyI6ImYyYzJhZGY0NzlkYTU1N2MzMjJmZjE2ODkzNjU0MWViNTM0ZDljNzU2NGE2YjExNmIwODUxZTZjYmYyNzQ3ODgifQ==',
            'middleName' => null,
            'lastName' => 'eyJpdiI6IkVTODZNSGF0Uk5LZm1CNkVwcENRUnc9PSIsInZhbHVlIjoic1V4bWhueHFrVWdybmxaVzV6eGk3dz09IiwibWFjIjoiZTczNjdkNThiMmU4ZjkyYjllMjJiNTM4NTVlN2U4MzkxMTFkODBjYzJmOTFjYjU3ZjQxNTNlMjkxMzdkNTc4OSJ9',
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
            'firstName' => 'eyJpdiI6Ijg3bHhDUEFWOCt5cEpcLzdTWUk2U1R3PT0iLCJ2YWx1ZSI6IklyWG9uMFA3WjluZ0xZVEgyNEppdFE9PSIsIm1hYyI6ImFkZWIzMGFlYWNlNWM2ZDVlNDc2MmZmZDVmZDc4Njk5ZDBiODdiMjY0M2E3Y2NkMWFkMjBmNDExODQwMTg3OGYifQ==',
            'middleName' => null,
            'lastName' => 'eyJpdiI6IjhSekZjT0N6UHNqYTM0WjI3eitkYUE9PSIsInZhbHVlIjoiTkJIUU1uc1wvTUR1TlMzTnFkaE1XRUNzYm1veUJoaWcyVTVaUDVUSVlYOTg9IiwibWFjIjoiNDIxMmY3NGY5OTgwZGM3MTRmZWUxMjI5YjYxZjc2OTA4NjdhMzdjY2ExN2VjMmNlODA5NGMyZDE5NWNiNmNjNSJ9',
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
            'firstName' => 'eyJpdiI6Ikx4bUdxZzMwcDN1WlR1S29nUXg5MFE9PSIsInZhbHVlIjoiMStBV1lpeVcyRTZlOGFhZHpGaVUwdz09IiwibWFjIjoiNzIzODEwOGNkYjY3MzVmNTIxNDUxZmFiYmIwODU0NzIwMDFmMzkxYTY1NWVjZTUzZTNhMGFlYmRlYThiNjAyYiJ9',
            'middleName' => null,
            'lastName' => 'eyJpdiI6InFkRVpnd29BblRUVExUZ1V0RHhvc3c9PSIsInZhbHVlIjoiNldld2tHZVFXN1RiZWdLRFR0WmVEUT09IiwibWFjIjoiOGRlOWQxNTE5OGMzNmFiZTE1ZjgyNTQxZmZkMGIwNTkwMzlhNjQxZGMzYjdlYzA5Yzk4YjFjZjE1ZjBkMjMwYyJ9',
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
            'firstName' => 'eyJpdiI6IjY4NFYzSEh4cTlVellBb0R0TzUyYmc9PSIsInZhbHVlIjoieHd5Q1hCcnJqS2xUZnIxZVF3OU1mQT09IiwibWFjIjoiZTJlYTQ5ZDM5MjNkNGE1ZjRjN2ExYmZlOGE0MjhlZTFjMWEyYmZmODVmODUwYzgxYzJhMzNlYzEyYTdhYWQzMiJ9',
            'middleName' => null,
            'lastName' => 'eyJpdiI6IjlLMjBlalJBN2ZnajE3RTBaMWkwMnc9PSIsInZhbHVlIjoiUlVMZExYQ29jcEhTYlkyd0xxeHR2dz09IiwibWFjIjoiNzkzOWZkNjVjMDIxNjdiNDhjYTYzOGNiMzUzYjI3YWJiMWQxYjY4ZGI2MDZkY2NlNWUxYzgwMmNjNmYzYmRkMyJ9',
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
            'firstName' => 'eyJpdiI6InJUemhkVURybGwrY2d4K1pqeWxyQWc9PSIsInZhbHVlIjoiT3pyQ1phRDFram1HQktEd0FERHUzQT09IiwibWFjIjoiOTE1MzExZTIwMzhkMzUzZTQ1MDZjNzQ4ZGU0ZWU2YjM1YmRkMTY4NzkwYzgzODEyMzBjN2IyMWQzNTQ2NDhjZSJ9',
            'middleName' => 'eyJpdiI6IlwvZ2lxSjJZTFIwcExVYUNQZ1l3Q3hBPT0iLCJ2YWx1ZSI6InI1UGpPVWQzWXhRb1wvOVhIXC8yeVpUQT09IiwibWFjIjoiMGViNjA1OGEyNzM5NmMwNmQzYTY3ZTE2MDAyZGY2NzQ3YzIyMmQ0ZjNhYTZlNGFkMzQ4N2Y5NDg1YTE4MmY1ZiJ9',
            'lastName' => 'eyJpdiI6InViUEhxaDVud3QwYzZjMDJLTnJpXC9BPT0iLCJ2YWx1ZSI6InJkV3dwN3h5XC8yTCsrVVk1WHFYSzNRPT0iLCJtYWMiOiJjMjE5NTRmY2NiNzc5NzEwZTM0MzI3OTJmYTYyYmRkMTM0MDk2YTEzNTMzMGI2OTA4ZTMxNWRhYzQxNmUyYzkyIn0=',
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
            'firstName' => 'eyJpdiI6IjcxTGFNYklWM1hnTXo3WU1FRXM4clE9PSIsInZhbHVlIjoiMGFETVV6eVpxbGhwb3dXVDFxM0wyQT09IiwibWFjIjoiZDBkYWU0ZTBmM2EwNWQ1N2VlMTI0NTFiOTM5NmFkYTdlYTFlODY4ZDNjMzkzZmE4NTM4ZjRmMGYyODU3ZDYwOSJ9',
            'middleName' => 'eyJpdiI6ImFTVmtjcWZrZDJsR3V1a0p4Z2hYXC9RPT0iLCJ2YWx1ZSI6Ik5RbVdYZUJTVFBOMGlEaFF3bkxGYmc9PSIsIm1hYyI6IjEyOTdhMDE2ZjczYmZiM2Q3N2ZkOWM3Y2M4NWRjYWJiNDAxYzkwMmY2NGMxMzI5NWU3ZWFiOWE4YmJmNDNhMTEifQ==',
            'lastName' => 'eyJpdiI6IllkWjFnSWt0bGF2MVRQOHd6ZEMzOFE9PSIsInZhbHVlIjoiZEEzTXJqOVRmbTFEQTNBU1FrUHQ0K2Yra2NXdmpscnNwMFBjYndRaktQRT0iLCJtYWMiOiJmZGNmYjE0ZGQ3YjdmMzFkZjNkZGU4OThjNzY5YjJlZjVkYTVlYWYyZGE1ODZlNzI0Njg5ZGU3NDJhNWE2ZmVlIn0=',
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
            'firstName' => 'eyJpdiI6IlBNeFh4QWlZbU81enhuYmxvZ3RJb2c9PSIsInZhbHVlIjoiSW5VbTErQkt0VU4yQWF4MWJ6ZmtKUT09IiwibWFjIjoiZWFjZDUyYzU0ZjEwZDM5NjlkNWI3OWNmYWMzM2E2ODdiNzE0MmM0NzljNzQwMWY5NTU5MGU1ZDk2NGFjNjU4MiJ9',
            'middleName' => null,
            'lastName' => 'eyJpdiI6IjFnYjF3QkZpQU8yOFVERTdyQUQ0OGc9PSIsInZhbHVlIjoiOTBodGNmeDJVUGw4Z05tWjF5T3E2Zz09IiwibWFjIjoiNDJiNzQzYzEyYWZlNzM2MTdlNGNhY2RjNjA1YWNmNDk2NDE4ZDRhNjE2MjhlMzJmZjVjODNkNDljYWQ0NmNlMCJ9',
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
            'firstName' => 'eyJpdiI6IkJucHU3MDVRZ0F1dFNKUjNaZlc5S1E9PSIsInZhbHVlIjoiWk96UldjMVpYdUMybDZvaWxRcWNWQT09IiwibWFjIjoiNTg4OTA0YjUzYTg2YWE3NDY1NjM2NmE0NzFkYjliMTU4NjNlZWIxNjc4YzNhZWM4NGYwMGUzYjJmMTM5NGNhYiJ9',
            'middleName' => null,
            'lastName' => 'eyJpdiI6Ik1JczU1SW9PMTFZdXZyUVwvUnhGbVlnPT0iLCJ2YWx1ZSI6ImZzTWptYXNwYVM2dUtYRTBcL3N0VEN3PT0iLCJtYWMiOiIxMzdjMmE4NWUxZjU5MDJmODIwNDgxMDdmNzNjMWJhMzBhMTJiOTA5Mjg0NGI0NjQzM2Q4N2MyYWIyZmIxMjdmIn0=',
            'avatar' => fread(fopen($filePath, "r"), filesize($filePath)),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);
    }
}
