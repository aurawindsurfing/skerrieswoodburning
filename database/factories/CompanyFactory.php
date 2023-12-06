<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
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
            'address' => $this->faker->streetAddress,
            'phone' => $this->faker->randomElement(['0862194744', '0868065966']),
            'email' => $this->faker->randomElement(['tomcentrumpl@gmail.com', 'alec@citltd.ie', 'hank@citltd.ie']),
            'tax' => $this->faker->randomNumber($nbDigits = 7, $strict = true).$this->faker->randomElement(['Q', 'W', 'E', 'R', 'T', 'Y']),
            'payment_method' => $this->faker->randomElement(['CC', 'EFT', 'Cash', 'Cheque']),
        ];
    }
}
