<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Safepass', 'Manual Handling']),
            'title' => 'SOLAS',
            'tutor_title' => 'SOLAS Accredited Tutor',
            'default_rate' => $this->faker->randomElement([85, 95, 100, 115, 130]),
            'objectives' => $this->faker->sentence($nbWords = 16),
            'who_should_attend' => $this->faker->sentence($nbWords = 8),
            'delegates' => $this->faker->sentence($nbWords = 8),
            'outline' => $this->faker->paragraphs($nb = 5, $asText = true),
            'duration' => $this->faker->randomElement(['Full Day', 'Half Day', '2 Day', '4 Day']),
            'certification' => $this->faker->paragraphs($nb = 2, $asText = true),
            'what_to_bring' => $this->faker->sentence($nbWords = 4),
            'start_time' => $this->faker->time($format = 'H:i', $max = 'now'),
            'plan_of_the_day' => $this->faker->paragraphs($nb = 3, $asText = true),
            'valid_for_years' => $this->faker->randomElement([4, 3, 5]),
            'capacity' => $this->faker->randomElement([5, 10, 15, 20]),
        ];
    }
}
