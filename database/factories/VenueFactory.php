<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address_line_1' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
            'phone' => $this->faker->e164PhoneNumber,
            'geo' => $this->faker->latitude($min = 53.00, $max = 53.60).', '.$this->faker->longitude($min = -6.22, $max = -7.22),
            'google_maps' => 'https://goo.gl/maps/qCRAyXZQy7S2',
        ];
    }
}
