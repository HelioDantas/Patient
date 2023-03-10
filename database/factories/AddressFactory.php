<?php

namespace Database\Factories;

use App\Models\Patient;
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
    public function definition(): array
    {
        return [
            'street' => fake()->name(),
            'zip_code' => Str::random(8),
            'street' => fake()->address(), 
            'number' => 10, 
            'complement' => fake()->name(), 
            'neighborhood' => fake()->name(),
            'state' => fake()->city(), 
            'city' => fake()->city(),
            'patient_id' => Patient::factory(),
        ];
    }
}
