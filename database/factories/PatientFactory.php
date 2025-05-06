<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        return [
            'primer_nombre' => fake()->firstName(),
            'otros_nombres' => fake()->firstName(),
            'primer_apellido' => fake()->lastName(),
            'segundo_apellido' => fake()->lastName(),
            'dni' => fake()->unique()->numerify('########'), // Genera un número único de 8 dígitos
            'secuencia' => fake()->randomElement(['L-M-V', 'M-J-S']),
            'turno' => fake()->randomElement(['I', 'II', 'III', 'IV']),
            'modulo' => fake()->randomElement(['Modulo 1', 'Modulo 2', 'Modulo 3']),
            'peso_seco' => fake()->randomFloat(2, 50, 120), // Peso seco con 2 decimales entre 50 y 120
            'acceso_arterial' => fake()->randomElement(['FAV', 'INJ', 'CVCL', 'CVCLP', 'CVCT']),
            'acceso_venoso' => fake()->randomElement(['FAV', 'INJ', 'CVCL', 'CVCLP', 'CVCT']),
            'estado' => fake()->randomElement(['ACTIVO', 'INACTIVO']),
            'codigo_cs' => Str::upper(Str::random(5) . fake()->unique()->numerify('#####') . Str::random(5)), // Genera código alfanumérico único de 15 caracteres
        ];
    }
}
