<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence();
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $slug = Str::slug($title, '-');
        $content = "<h1>{$title}</h1>";
        foreach ($paragraphs as $para) {
            $content .= "<p>{$para}</p>";
        }
        
        return [
            'position' => $this->faker->unique()->numberBetween(1, 8),
            'title' => $title,
            'linkname' => $this->faker->word,
            'slug' => $slug,
            'description' => $this->faker->paragraph,
            'content' => $content,
            'image' => $this->faker->imageUrl(600, 800, 'cats'),
            'showServices' => true,
            'showAccreditations' => true,
            'showCategories' => true
        ];
    }
}
