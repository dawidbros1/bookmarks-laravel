<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => 'category',
            'parent_id' => 1,
            'name' => $this->faker->text(20),
            'image_url' => $this->faker->imageUrl(),
            'link' => $this->faker->url(),
            'private' => rand(0, 1),
            'hidden' => rand(0, 1),
        ];
    }
}
