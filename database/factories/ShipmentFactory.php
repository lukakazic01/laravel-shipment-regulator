<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'from_city' => fake()->city(),
            'from_country' => fake()->country(),
            'to_city' => fake()->city(),
            'to_country' => fake()->country(),
            'price' => fake()->numberBetween(1, 1000),
            'status' => fake()->randomElement(['pending', 'delivered', 'cancelled']),
            'details' => fake()->text(),
        ];
    }
}
