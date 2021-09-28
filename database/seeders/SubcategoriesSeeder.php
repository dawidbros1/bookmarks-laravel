<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $img = 'https://artnapi.pl/pol_pl_Kot-w-Miami-Malowanie-po-numerach-1242_1.jpg';

        // PODKATEGORIE
        DB::table('subcategories')->truncate();

        DB::table('subcategories')->insert(
            [
                ['id' => 1, 'category_id' => 1, 'name' => "Numer one", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['id' => 2, 'category_id' => 1, 'name' => "Numer jeden", 'image_url' => $img, 'public' => 0, 'hidden' => 1, 'order' => 0],
                ['id' => 3, 'category_id' => 1, 'name' => "Numer ein", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['id' => 4, 'category_id' => 2, 'name' => "troche xd", 'image_url' => $img, 'public' => 0, 'hidden' => 1, 'order' => 0],
                ['id' => 5, 'category_id' => 2, 'name' => "no nie powiem", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['id' => 6, 'category_id' => 2, 'name' => "co ty na to", 'image_url' => $img, 'public' => 0, 'hidden' => 1, 'order' => 0],
                ['id' => 7, 'category_id' => 3, 'name' => "ziom, czy ty", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['id' => 8, 'category_id' => 3, 'name' => "mnie w ogule", 'image_url' => $img, 'public' => 0, 'hidden' => 1, 'order' => 0],
                ['id' => 9, 'category_id' => 3, 'name' => "słuchasz? hee..", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 0],
            ],
        );
    }
}
