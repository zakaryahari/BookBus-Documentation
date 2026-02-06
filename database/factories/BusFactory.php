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
            'immatriculation' => fake()->unique()->numerify('#####') . '-' . fake()->randomLetter() . '-' . fake()->numerify('##'),
            'modele' => fake()->randomElement(['Mercedes Sprinter', 'Iveco Daily', 'Renault Master', 'Ford Transit']),
            'capacite' => fake()->numberBetween(30, 60),
            'statut' => fake()->randomElement(['actif', 'maintenance', 'hors_service']),
        ];
    }
}