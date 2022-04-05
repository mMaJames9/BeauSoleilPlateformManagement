<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label_service' => $this->faker->unique()->jobTitle(),
            'price_service' => $this->faker->numberBetween($min = 500, $max = 10000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
