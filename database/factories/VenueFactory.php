<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fsa_id' => $this->faker->numberBetween(1, 3000),
            'user_id' => $this->faker->numberBetween(1, 10),
            'email' => $this->faker->email,
            'venuename' => $this->faker->company,
            'slug' => $this->faker->slug,
            'venuetype' => $this->faker->word,
            'address' => $this->faker->streetName,
            'address2' => $this->faker->secondaryAddress,
            'town' => $this->faker->state,
            'county' => $this->faker->city,
            'postcode' => $this->faker->postcode,
            'postalsearch' => $this->faker->word,
            'telephone' => $this->faker->phoneNumber,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'local_authority' => $this->faker->word,
            'website' => $this->faker->url,
            'photo' => $this->faker->image,
            'is_live' => $this->faker->numberBetween(0,1)
        ];
    }
}
