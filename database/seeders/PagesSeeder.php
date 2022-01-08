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

        DB::table('pages')->insert($pages);

        // DB::table('pages')->insert(
        //     [
        //         // Dla ketegorii
        //         ['type' => 'category', 'parent_id' => 1, 'name' => "USER 1 CAT 1 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 2],
        //         ['type' => 'category', 'parent_id' => 1, 'name' => "USER 1 CAT 1 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 1],
        //         ['type' => 'category', 'parent_id' => 1, 'name' => "USER 1 CAT 1 PAGE 3", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'category', 'parent_id' => 2, 'name' => "USER 1 CAT 2 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'category', 'parent_id' => 2, 'name' => "USER 1 CAT 2 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'category', 'parent_id' => 3, 'name' => "USER 2 CAT 1 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'category', 'parent_id' => 3, 'name' => "USER 2 CAT 1 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'category', 'parent_id' => 4, 'name' => "USER 2 CAT 2 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'category', 'parent_id' => 4, 'name' => "USER 2 CAT 2 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],

        //         // Dla podkategorii
        //         ['type' => 'subcategory', 'parent_id' => 1, 'name' => "USER 1 CAT 1 SUB 1 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 1, 'name' => "USER 1 CAT 1 SUB 1 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 2, 'name' => "USER 1 CAT 1 SUB 2 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 2, 'name' => "USER 1 CAT 1 SUB 2 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 3, 'name' => "USER 1 CAT 2 SUB 1 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 3, 'name' => "USER 1 CAT 2 SUB 1 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 4, 'name' => "USER 1 CAT 2 SUB 2 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 4, 'name' => "USER 1 CAT 2 SUB 2 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],

        //         ['type' => 'subcategory', 'parent_id' => 5, 'name' => "USER 2 CAT 1 SUB 1 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 5, 'name' => "USER 2 CAT 1 SUB 1 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 6, 'name' => "USER 2 CAT 1 SUB 2 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 6, 'name' => "USER 2 CAT 1 SUB 2 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 7, 'name' => "USER 2 CAT 2 SUB 1 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 7, 'name' => "USER 2 CAT 2 SUB 1 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 8, 'name' => "USER 2 CAT 2 SUB 2 PAGE 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //         ['type' => 'subcategory', 'parent_id' => 8, 'name' => "USER 2 CAT 2 SUB 2 PAGE 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
        //     ],
        // );
    }
}
