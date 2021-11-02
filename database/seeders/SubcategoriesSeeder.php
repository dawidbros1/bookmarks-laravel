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
                ['id' => 1, 'category_id' => 1, 'name' => "USER 1 CAT 1", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['id' => 2, 'category_id' => 1, 'name' => "USER 1 CAT 1", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 1],
                ['id' => 3, 'category_id' => 2, 'name' => "USER 1 CAT 2", 'image_url' => $img, 'public' => 1, 'hidden' => 0, 'order' => 1],
                ['id' => 4, 'category_id' => 2, 'name' => "USER 1 CAT 2", 'image_url' => $img, 'public' => 1, 'hidden' => 0, 'order' => 0],
                ['id' => 5, 'category_id' => 3, 'name' => "USER 2 CAT 1", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['id' => 6, 'category_id' => 3, 'name' => "USER 2 CAT 1", 'image_url' => $img, 'public' => 0, 'hidden' => 0, 'order' => 1],
                ['id' => 7, 'category_id' => 4, 'name' => "USER 2 CAT 2", 'image_url' => $img, 'public' => 1, 'hidden' => 0, 'order' => 1],
                ['id' => 8, 'category_id' => 4, 'name' => "USER 2 CAT 2", 'image_url' => $img, 'public' => 1, 'hidden' => 0, 'order' => 0],
            ],
        );
    }
}
