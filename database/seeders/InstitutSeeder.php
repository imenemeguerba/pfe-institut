<?php

namespace Database\Seeders;

use App\Models\Institut;
use Illuminate\Database\Seeder;

class InstitutSeeder extends Seeder
{
    public function run(): void
    {
        // Créer l'instance unique avec valeurs par défaut
        Institut::firstOrCreate(
            ['id' => 1],
            [
                'nom' => 'Institut de Beauté',
                'description' => 'Votre institut de beauté professionnel pour des soins de qualité dans une ambiance chaleureuse.',
                'email' => 'contact@institut-beaute.dz',
                'telephone' => '0555000000',
                'adresse' => 'Adresse à configurer',
                'ville' => 'Alger',
                'code_postal' => '16000',
                'taux_tva' => 19.00,
                'seuil_affluence_eleve' => 10,
                'seuil_affluence_moyen' => 5,
                'horaires_ouverture' => [
                    'lundi'    => ['ouvert' => true, 'matin' => '09:00-12:00', 'apres_midi' => '14:00-18:00'],
                    'mardi'    => ['ouvert' => true, 'matin' => '09:00-12:00', 'apres_midi' => '14:00-18:00'],
                    'mercredi' => ['ouvert' => true, 'matin' => '09:00-12:00', 'apres_midi' => '14:00-18:00'],
                    'jeudi'    => ['ouvert' => true, 'matin' => '09:00-12:00', 'apres_midi' => '14:00-18:00'],
                    'vendredi' => ['ouvert' => false],
                    'samedi'   => ['ouvert' => true, 'matin' => '09:00-13:00', 'apres_midi' => null],
                    'dimanche' => ['ouvert' => false],
                ],
            ]
        );
    }
}
