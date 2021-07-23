<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'venue_id' => $this->faker->numberBetween(1, 529),
	        'eventName' => $this->faker->sentence,
            'slug' => $this->faker->slug,
	        'eventPhoto' => $this->faker->image,
	        'eventDate' => $this->faker->date,
	        'eventTimeStart' => $this->faker->time,
	        'eventTimeEnd' => $this->faker->time,
	        'eventType' => $this->faker->word,
	        'eventCost' => $this->faker->numberBetween(20, 200),
	        'is_live' => $this->faker->numberBetween(0, 1),
        ];
    }
}
