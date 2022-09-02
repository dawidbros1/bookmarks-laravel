<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
                [
                    'id' => 1,
                    'name' => "Lucky2007",
                    'email' => 'user01@wp.pl',
                    'password' => '$2y$10$3b6H/9J2bspYVAYDMSp6je/fU.xmHQktomwrQ5JLkRepk2cXTqGvK',
                ],
                [
                    'id' => 2,
                    'name' => "Olivia",
                    'email' => 'user02@wp.pl',
                    'password' => '$2y$10$3b6H/9J2bspYVAYDMSp6je/fU.xmHQktomwrQ5JLkRepk2cXTqGvK',
                ],
            ],
        );
    }
}
