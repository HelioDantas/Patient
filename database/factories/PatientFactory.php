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
    public function definition(): array
    {
        return [
            'full_name' => fake('pt_BR')->name(),
            'mom_full_name' => fake('pt_BR')->name(),
            'cns' => fake('pt_BR')->cpf(),
            'cpf' => fake('pt_BR')->cpf(),
            'birthday' => fake('pt_BR')->date('Y-m-d',  'now'),
            'photo_url' => fake('pt_BR')->url(),
        ];
    }
}
