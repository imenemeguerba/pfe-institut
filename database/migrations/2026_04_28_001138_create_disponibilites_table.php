<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->id();

            // L'esthéticienne concernée
            $table->foreignId('estheticienne_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Jour de la semaine (1=lundi, 2=mardi, ..., 7=dimanche)
            $table->tinyInteger('jour_semaine');

            // Heures de travail
            $table->time('heure_debut');
            $table->time('heure_fin');

            // Permet de désactiver une dispo sans la supprimer
            $table->boolean('actif')->default(true);

            $table->timestamps();

            // Index pour accélérer les recherches par esthéticienne + jour
            $table->index(['estheticienne_id', 'jour_semaine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disponibilites');
    }
};
