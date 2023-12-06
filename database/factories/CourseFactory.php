<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tutor_id' => App\Tutor::all(['id'])->random(),
            'venue_id' => App\Venue::all(['id'])->random(),
            'date' => $this->faker->dateTimeBetween('-3 months', '+3 months'),
            'time' => $this->faker->randomElement(['08:00', '08:30', '09:00']),
            'price' => $this->faker->randomElement([85, 95, 105, 115, 120]),
            'inhouse' => $this->faker->boolean,
            'multiday' => $this->faker->boolean,
            'capacity' => $this->faker->randomElement([20, 10, 15, 5]),
            'course_type_id' => App\CourseType::all(['id'])->random(),
        ];
    }
}
