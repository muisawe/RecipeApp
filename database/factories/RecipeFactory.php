<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'prep_time' => $this->faker->date,
            'calories' => $this->faker->numberBetween(1, 1000),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->text,
            'name' => $this->faker->word,   
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
