<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\SubcategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    private $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SubcategoryFactory $factory)
    {
        $this->checkRequirements();

        DB::table('subcategories')->truncate();
        $subcategories = [];

        for ($i = 1; $i <= 25; $i++) {
            array_push($subcategories, $factory->make([
                'category_id' => $this->randomCategory()->id,
            ])->toArray());
        }

        DB::table('subcategories')->insert($subcategories);
    }

    private function checkRequirements()
    {
        if (count($this->categories) == 0) {
            $this->command->error("Categories doen't exists. Please use command `php artisan db:seed --class=CategorySeeder` to generate categories!");
            exit();
        }
    }

    private function randomCategory()
    {
        return $this->categories[rand(0, count($this->categories) - 1)];
    }
}
