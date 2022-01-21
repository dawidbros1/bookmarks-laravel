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
        $img = "https://cdn-icons.flaticon.com/png/512/3720/premium/3720439.png?token=exp=1638888861~hmac=b047928907faeeee0c432b6d5f176f80";

        $categories = [];

        for ($i = 1; $i <= 5; $i++) {
            array_push($categories, ['user_id' => 1, 'name' => "Kategoria " . $i, 'image_url' => $img]);
        }

        // DB::table('categories')->insert($categories);
    }
}
