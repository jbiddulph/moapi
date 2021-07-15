<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'categoryimg' => $this->faker->imageUrl(800, 600, 'birds'),
            'categorytitle' => $this->faker->sentence(),
            'categorytext' => $this->faker->paragraph(),
            'categorylink' => $this->faker->url,
        ];
    }
}
