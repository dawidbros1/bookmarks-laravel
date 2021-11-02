<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert(
            [
                ['id' => 1, 'name' => "dawidbros1", 'email' => 'dawidbros1@wp.pl', 'password' => '$2y$10$ktDLb.p.l8u2RrJMyoX5/uh0QbjtBnkDuqLSUKA94beTzDfIvFtuS'],
                ['id' => 2, 'name' => "konto2", 'email' => 'konto2@wp.pl', 'password' => '$2y$10$7k0fafV7fvFeaAXdO19ZzuqiZM91RVcmyzQlxaVDoQ.2HoeyiV4hO'],
            ],
        );
    }
}
