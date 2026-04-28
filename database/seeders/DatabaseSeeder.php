<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('=== Démarrage du seeding ===');
        $this->command->info('');

        $this->call([
            AdminSeeder::class,
            CategorieSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('=== Seeding terminé avec succès ===');
        $this->command->info('');
    }
}
