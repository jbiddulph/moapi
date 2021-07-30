<?php

namespace Database\Factories;

use App\Models\Header;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Header::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(1200, 600, 'reptiles'),
        ];
    }
}
