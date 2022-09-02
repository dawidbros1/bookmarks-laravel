<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    private $users;

    public function __construct()
    {
        $this->users = User::all();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CategoryFactory $factory)
    {
        $this->checkRequirements();

        DB::table('categories')->truncate();
        $categories = [];

        for ($i = 1; $i <= 10; $i++) {
            array_push($categories, $factory->make([
                'user_id' => $this->randomUser()->id,
            ])->toArray());
        }

        DB::table('categories')->insert($categories);
    }

    private function checkRequirements()
    {
        if (count($this->users) == 0) {
            $this->command->error("Users doen't exists. Please use command `php artisan db:seed --class=UserSeeder` to generate users!");
            exit();
        }
    }
    private function randomUser()
    {
        return $this->users[rand(0, count($this->users) - 1)];
    }
}
