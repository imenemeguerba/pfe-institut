<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();

            // Numéro de facture lisible (ex: "FAC-2026-00001")
            $table->string('numero', 30)->unique();

            // Le client concerné
            $table->foreignId('client_id')
                  ->constrained('users')
                  ->onDelete('restrict');

            // Type de facture : RDV ou Commande
            $table->enum('type', ['rendez_vous', 'commande']);

            // FK vers RDV (rempli si type=rendez_vous, NULL sinon)
            $table->foreignId('rendez_vous_id')
                  ->nullable()
                  ->constrained('rendez_vous')
                  ->onDelete('restrict');

            // FK vers commande (rempli si type=commande, NULL sinon)
            $table->foreignId('commande_id')
                  ->nullable()
                  ->constrained('commandes')
                  ->onDelete('restrict');

            // Montants (snapshot au moment de génération)
            $table->integer('montant_ht');     // Hors taxes
            $table->integer('montant_tva');    // Montant TVA
            $table->integer('montant_ttc');    // Toutes taxes comprises
            $table->decimal('taux_tva', 5, 2)->default(19.00); // 19% en Algérie

            // Date d'émission
            $table->dateTime('date_emission');

            // Chemin du PDF généré (stockage)
            $table->string('chemin_pdf')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('client_id');
            $table->index(['type', 'date_emission']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
