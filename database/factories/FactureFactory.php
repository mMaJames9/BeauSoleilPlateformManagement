<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'num_ticket' => $this->faker->unique()->bothify('#?#?##'),
            'total_price' => $this->faker->numberBetween($min = 500, $max = 50000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
