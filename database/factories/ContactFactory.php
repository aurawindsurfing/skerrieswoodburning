<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->randomElement(['0862194744', '0868065966']),
            'email' => $this->faker->randomElement(['tomcentrumpl@gmail.com', 'alec@citltd.ie', 'hank@citltd.ie']),
            'accounts_payable' => $this->faker->randomElement([true, false]),
            'company_id' => \App\Company::factory()->create()->id,
        ];
    }
}
