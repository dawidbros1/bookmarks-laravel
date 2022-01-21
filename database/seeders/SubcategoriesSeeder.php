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
        DB::table('subcategories')->truncate();

        $img = "https://cdn-icons-png.flaticon.com/512/3767/3767084.png";
        $subcategories = [];

        for ($i = 1; $i <= 20; $i++) {
            array_push($subcategories, ['category_id' => random_int(1, 5), 'name' => "Podkategoria " . $i, 'image_url' => $img]);
        }

        // DB::table('subcategories')->insert($subcategories);
    }
}
