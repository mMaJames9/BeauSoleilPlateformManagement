<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_client' => $this->faker->name(),
            'phone_number' => $this->faker->unique()->numerify('69#-###-###'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
