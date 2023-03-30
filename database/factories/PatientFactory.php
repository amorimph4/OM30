<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'photo' => fake()->imageUrl(),
            'mother_name' => fake()->name(),
            'birth_date' => fake()->date(),
            'cpf' => fake()->numerify('##############'),
            'cns' => fake()->numerify('##############'),
        ];
    }
}
