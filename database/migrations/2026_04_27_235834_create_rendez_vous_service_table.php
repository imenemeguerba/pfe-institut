<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendez_vous_service', function (Blueprint $table) {
            $table->id();

            // Les 2 foreign keys
            $table->foreignId('rendez_vous_id')
                  ->constrained('rendez_vous')
                  ->onDelete('cascade');

            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('restrict');

            // 🔥 SNAPSHOT : on sauvegarde prix + durée AU MOMENT de la réservation
            $table->integer('prix_au_moment');
            $table->integer('duree_au_moment'); // En minutes

            $table->timestamps();

            // Empêche le même service d'être ajouté 2 fois au même RDV
            $table->unique(['rendez_vous_id', 'service_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendez_vous_service');
    }
};
