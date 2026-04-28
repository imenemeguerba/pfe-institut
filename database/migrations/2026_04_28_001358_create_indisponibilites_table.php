<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indisponibilites', function (Blueprint $table) {
            $table->id();

            // L'esthéticienne concernée
            $table->foreignId('estheticienne_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Période d'indisponibilité (datetime exact)
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');

            // Type d'indisponibilité
            $table->enum('type', [
                'conge',
                'ferie',
                'maladie',
                'formation',
                'autre'
            ])->default('autre');

            // Raison/note (optionnel)
            $table->string('motif')->nullable();

            $table->timestamps();

            // Index pour accélérer les recherches
            $table->index(['estheticienne_id', 'date_debut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indisponibilites');
    }
};
