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

        // DB::table('users')->insert(
        //     [
        //         ['id' => 1, 'name' => "admin123", 'email' => 'admin123@wp.pl', 'password' => '$2y$10$VPFV/bdUB.N9dMIWl0IozO1qpCdTfMynAlQ0ouWafxymxlJFDps5W'],
        //     ],
        // );
    }
}
