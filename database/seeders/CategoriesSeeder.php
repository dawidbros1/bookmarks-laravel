<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert(
            [
                // Dla użytkownika ID=1
                ['id' => 1, 'user_id' => 1, 'name' => 'USER 1 PRI', 'image_url' => 'https://pbs.twimg.com/profile_images/1251882227916582912/QxERzILG_400x400.jpg', 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['id' => 2, 'user_id' => 1, 'name' => 'USER 1 PUB', 'image_url' => 'https://pbs.twimg.com/profile_images/1251882227916582912/QxERzILG_400x400.jpg', 'public' => 1, 'hidden' => 0, 'order' => 1],
                // Dla użytkownika ID=2
                ['id' => 3, 'user_id' => 2, 'name' => 'USER 2 PRI', 'image_url' => 'https://play-lh.googleusercontent.com/ksYeJ3BhQ1pg_cCwtFR_pT2Lh0Clc9iVFYiOhuiK4B3FwlUDCN7qya1EGIBrP4H078Q', 'public' => 0, 'hidden' => 0, 'order' => 1],
                ['id' => 4, 'user_id' => 2, 'name' => 'USER 2 PUB', 'image_url' => 'https://a.allegroimg.com/original/11b7a0/67463ccc4447a0ada526cdd3b5bc/PHASMOPHOBIA-STEAM-NOWA-GRA-PELNA-WERSJA-PC-PL', 'public' => 1, 'hidden' => 0, 'order' => 0],
            ],
        );
    }
}
