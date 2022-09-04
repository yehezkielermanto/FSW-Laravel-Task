<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Yehezkiel',
            'email' => 'yehezkiel.ermanto28@gmail.com',
            'email_verified_at' => date(now()),
            'password' => 'yehezkiel123',
            'remember_token' => '123',
            'created_at' => date(now()),
            'updated_at' => date(now()),
        ]);
    }
}
