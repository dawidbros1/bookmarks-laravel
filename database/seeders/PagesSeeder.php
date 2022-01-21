<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->truncate();

        $img = "https://cdn-icons.flaticon.com/png/512/1008/premium/1008686.png?token=exp=1638888973~hmac=d0b6bd74f7013e977bd10770d4228902";
        $pages = [];
        $types = ['category', 'subcategory'];

        for ($i = 1; $i < 200; $i++) {
            array_push($pages, ['type' => $types[$i % 2], 'parent_id' => random_int(1, 5), 'name' => "Strona " . $i, 'image_url' => $img, 'link' => "#"]);
        }

        // DB::table('pages')->insert($pages);
    }
}
