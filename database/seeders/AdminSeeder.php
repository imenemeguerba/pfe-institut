<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si l'admin existe déjà (évite les doublons si on relance le seed)
        $exists = DB::table('users')
            ->where('email', 'admin@institut-beaute.dz')
            ->exists();

        if ($exists) {
            $this->command->info('Admin déjà existant, skip.');
            return;
        }

        // Créer le compte admin
        DB::table('users')->insert([
            'name' => 'Administrateur',
            'email' => 'admin@institut-beaute.dz',
            'role' => 'admin',
            'telephone' => '0555000000',
            'photo' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('Imene@2026'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('✓ Admin créé avec succès !');
        $this->command->info('  Email    : admin@institut-beaute.dz');
        $this->command->info('  Password : Imene@2026');
    }
}
