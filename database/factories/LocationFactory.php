<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();

        return [
            'town' => $title,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(1200, 600, 'reptiles'),
        ];
    }
}
