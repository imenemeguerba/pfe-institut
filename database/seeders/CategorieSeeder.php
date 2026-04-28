<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des catégories à insérer
        $categories = [
            [
                'nom' => 'Soins du visage',
                'description' => 'Nettoyage profond, hydrafacial, soins anti-âge, masques, peeling et traitements spécialisés pour le visage.',
            ],
            [
                'nom' => 'Soins du corps',
                'description' => 'Gommage, massages, enveloppements et soins relaxants ou revitalisants pour le corps.',
            ],
            [
                'nom' => 'Épilation',
                'description' => 'Épilation à la cire, au laser, au fil ou au sucre pour une peau douce et soignée.',
            ],
            [
                'nom' => 'Onglerie',
                'description' => 'Manucure, pédicure, pose de gel, vernis semi-permanent et créations nail art.',
            ],
            [
                'nom' => 'Coiffure',
                'description' => 'Coupe, brushing, coloration, mèches, lissage et soins capillaires adaptés à tous types de cheveux.',
            ],
            [
                'nom' => 'Maquillage',
                'description' => 'Maquillage professionnel pour le quotidien, les soirées, les mariages et événements spéciaux.',
            ],
            [
                'nom' => 'Sourcils & Cils',
                'description' => 'Extensions, rehaussement, microblading, microshading et soins esthétiques du regard.',
            ],
            [
                'nom' => 'Spa & Hammam',
                'description' => 'Hammam, sauna, bains vapeur, gommages orientaux et rituels de détente.',
            ],
            [
                'nom' => 'Minceur & Bien-être',
                'description' => 'Drainage, soins minceur, anti-cellulite et programmes dédiés au bien-être physique.',
            ],
            [
                'nom' => 'Soins esthétiques avancés',
                'description' => 'Radiofréquence, HIFU, cryolipolyse, peeling médical et technologies esthétiques innovantes.',
            ],
            [
                'nom' => 'Packs & Offres spéciales',
                'description' => 'Formules mariée, événements, offres duo et promotions exclusives adaptées à chaque occasion.',
            ],
        ];

        // Vérifier si déjà seedé (évite les doublons)
        if (DB::table('categories')->count() > 0) {
            $this->command->info('Catégories déjà existantes, skip.');
            return;
        }

        // Ajouter les champs communs à toutes les catégories
        $now = now();
        foreach ($categories as &$categorie) {
            $categorie['image'] = null;
            $categorie['actif'] = true;
            $categorie['created_at'] = $now;
            $categorie['updated_at'] = $now;
        }

        // Insertion en bulk (1 seule requête SQL = plus performant)
        DB::table('categories')->insert($categories);

        $this->command->info('✓ ' . count($categories) . ' catégories créées avec succès !');
    }
}
