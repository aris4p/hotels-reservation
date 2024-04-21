<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'nik' => $this->faker->unique()->numerify('##########'), // Example: 1234567890
            'email' => $this->faker->unique()->safeEmail,
            'nohp' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'jeniskelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tgllahir' => $this->faker->date(),
        ];
    }
}
