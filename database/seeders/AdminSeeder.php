<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
         'name' => 'General Admin',
         'email' => 'arman-aleqyan@mail.ru',
         'password' => Hash::make('11111111'),
         'email_verify' => 1,
         'phone_verify' => 1,
         'role_id' => 1,
         'shop_id' => time(),
      ]);
    }
}
