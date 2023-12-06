<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'course_id' => App\Course::all(['id'])->random(),
            'venue_id' => App\Venue::all(['id'])->random(),
            'date' => $this->faker->dateTimeBetween('-3 months', '+3 months'),
            'time' => $this->faker->randomElement(['08:00', '08:30', '09:00']),

        ];
    }
}
