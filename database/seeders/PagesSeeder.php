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

        DB::table('pages')->insert(
            [
                // Dla ketegorii
                ['type' => 'category', 'parent_id' => 1, 'name' => "abc 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 1, 'name' => "abc 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 1, 'name' => "abc 1", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 2, 'name' => "abc 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 2, 'name' => "abc 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 2, 'name' => "abc 2", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 3, 'name' => "abc 3", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 3, 'name' => "abc 3", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'category', 'parent_id' => 3, 'name' => "abc 3", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],

                // Dla podkategorii
                ['type' => 'subcategory', 'parent_id' => 1, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 1, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 1, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 4, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 4, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 4, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 7, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 7, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
                ['type' => 'subcategory', 'parent_id' => 7, 'name' => "abc", 'image_url' => "url", 'link' => "link", 'public' => 0, 'hidden' => 0, 'order' => 0],
            ],
        );
    }
}
