<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricule' => fake()->unique()->numerify('#####') . '-' . fake()->randomLetter() . '-' . fake()->numerify('##'),
            'capacite' => fake()->numberBetween(30, 60),
            'statut' => fake()->randomElement(['Actif', 'En maintenance', 'Hors service']),
        ];
    }
}