<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Password>
 */
class PasswordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vault_id' => rand(1, 500), // Випадковий Vault ID
            'name' => $this->faker->word(), // Генеруємо випадкову назву
            'description' => $this->faker->sentence(), // Випадковий опис
            'value' => $this->faker->password(10, 20), // Випадковий пароль
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
