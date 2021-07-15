<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_name' => $this->faker->word,
            'slogan' => $this->faker->sentence,
            'telephone' => $this->faker->phoneNumber,
            'address' => $this->faker->paragraph,
            'officehours' => $this->faker->paragraph,
            'servicelist' => $this->faker->paragraph,
            'servicebackground' => $this->faker->paragraph,
            'servicesintro' => $this->faker->paragraph,
            'accreditations' => $this->faker->paragraph,
            'logo' => $this->faker->imageUrl(200, 150, 'clouds'),
            'email' => $this->faker->email,
            'facebook' => $this->faker->word,
            'google' => $this->faker->word,
            'instagram' => $this->faker->word,
            'twitter' => $this->faker->word,
            'youtube' => $this->faker->word,
            'whatsapp' => $this->faker->word
        ];
    }
}
