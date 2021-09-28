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

        DB::table('categories')->insert(
            [
                ['id' => 1, 'user_id' => 1, 'name' => 'Coś tam', 'image_url' => 'https://f4.bcbits.com/img/0017296575_10.jpg', 'public' => 0, 'hidden' => 0, 'order' => 1],
                ['id' => 2, 'user_id' => 1, 'name' => 'O co chodzi', 'image_url' => 'https://wiecejnizkarma.pl/wp-content/uploads/2017/03/kot.jpg', 'public' => 0, 'hidden' => 0, 'order' => 1],
                ['id' => 3, 'user_id' => 1, 'name' => 'Gdzie ja jestem', 'image_url' => 'https://artnapi.pl/pol_pl_Kot-w-Miami-Malowanie-po-numerach-1242_1.jpg', 'public' => 1, 'hidden' => 1, 'order' => 1],
            ],
        );
    }
}
