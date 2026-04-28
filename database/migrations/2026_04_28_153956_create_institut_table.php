<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institut', function (Blueprint $table) {
            $table->id();

            // Identité de l'institut
            $table->string('nom', 150);
            $table->text('description')->nullable();

            // Coordonnées
            $table->string('email', 150);
            $table->string('telephone', 20);
            $table->string('adresse', 255);
            $table->string('ville', 100)->nullable();
            $table->string('code_postal', 10)->nullable();

            // Logo
            $table->string('logo')->nullable();

            // Réseaux sociaux (optionnels)
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('whatsapp')->nullable();

            // Horaires d'ouverture (JSON pour flexibilité)
            $table->json('horaires_ouverture')->nullable();

            // Paramètres business
            $table->decimal('taux_tva', 5, 2)->default(19.00); // 19% en Algérie
            $table->integer('seuil_affluence_eleve')->default(10); // Ex: 10+ RDV/jour = élevé
            $table->integer('seuil_affluence_moyen')->default(5);  // Ex: 5-9 RDV/jour = moyen

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institut');
    }
};
