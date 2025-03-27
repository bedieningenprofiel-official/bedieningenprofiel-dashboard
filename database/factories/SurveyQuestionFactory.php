<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SurveyQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'survey_id' => 1,
            'left_statement' => fake()->sentence(),
            'right_statement' => fake()->sentence(),
            'left_personality_id' => 1,
            'right_personality_id' => 2,
        ];
    }
}
