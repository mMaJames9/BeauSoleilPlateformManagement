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
            'label_service' => $this->faker->jobTitle(),
            'price_service' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
