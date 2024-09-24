<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Password;

class PasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($vaultId = 1; $vaultId <= 500; $vaultId++) {
            Password::factory()
                ->count(rand(5, 15)) // Генеруємо від 5 до 15 паролів
                ->create(['vault_id' => $vaultId]); // Прив'язуємо до конкретного Vault ID
        }
    }
}
