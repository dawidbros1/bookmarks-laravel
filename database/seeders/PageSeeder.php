<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Database\Factories\PageFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    private $categories;
    private $subcategories;
    private $types = [];

    public function __construct()
    {
        $this->categories = Category::all();
        $this->subcategories = Subcategory::all();
        $this->initTypes();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PageFactory $factory)
    {
        $this->checkRequirements();

        DB::table('pages')->truncate();
        $pages = [];

        for ($i = 1; $i <= 1000; $i++) {
            $type = $this->randomType();

            array_push($pages, $factory->make([
                'type' => $type,
                'parent_id' => $this->randomParent($type)->id,
            ])->toArray());
        }

        DB::table('pages')->insert($pages);
    }

    private function checkRequirements()
    {
        if (count($this->categories) == 0 || count($this->subcategories) == 0) {
            $this->command->error("Categories and Subcategories does not exists");
            $this->command->error("Please use command `php artisan db:seed --class=CategorySeeder` to generate categories!");
            $this->command->error("Please use command `php artisan db:seed --class=SubcategorySeeder` to generate subcategories!");
            exit();
        }
    }

    private function initTypes()
    {
        if (count($this->categories) != 0) {array_push($this->types, 'category');}
        if (count($this->subcategories) != 0) {array_push($this->types, 'subcategory');}
    }

    private function randomType()
    {
        return $this->types[rand(0, count($this->types) - 1)];
    }

    private function randomParent(string $type)
    {
        $parent = ($type == "category") ? $this->categories : $this->subcategories;
        return $parent[rand(0, count($parent) - 1)];
    }
}
