<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city' => fake()->city(),
            'neighborhood' => fake()->address(),
            'number' => fake()->randomNumber(),
            'state' => Str::random(2),
            'street' => fake()->streetAddress(),
            'zip_code' => fake()->numerify('########'),
        ];
    }
}
