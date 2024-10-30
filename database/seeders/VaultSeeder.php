<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vault;
use Illuminate\Database\Seeder;

class VaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all users and create vaults for each
        User::all()->each(function ($user) {
            // Adjust the number of vaults per user as needed
            Vault::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
