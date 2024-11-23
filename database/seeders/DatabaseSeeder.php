<?php

namespace Database\Seeders;

use App\Models\User;

use App\Models\Vault;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create()->each(function ($user) {
            Vault::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });

        $this->call(PasswordSeeder::class);
    }
}
