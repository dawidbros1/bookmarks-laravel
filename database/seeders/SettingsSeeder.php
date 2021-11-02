<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        DB::table('settings')->insert(
            [
                ['id' => 1, 'user_id' => '1', 'category_public' => '0', 'subcategory_public' => '1', 'page_public' => '1', 'page_open_in_new_window' => '0'],
                ['id' => 2, 'user_id' => '2', 'category_public' => '1', 'subcategory_public' => '0', 'page_public' => '0', 'page_open_in_new_window' => '1'],
            ],
        );
    }
}
