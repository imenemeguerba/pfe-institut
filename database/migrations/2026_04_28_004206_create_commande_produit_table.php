<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commande_produit', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->onDelete('cascade');

            $table->foreignId('produit_id')
                  ->constrained('produits')
                  ->onDelete('restrict');

            // Quantité commandée
            $table->integer('quantite');

            // 🔥 SNAPSHOT : prix au moment de la commande
            $table->integer('prix_au_moment');

            $table->timestamps();

            // Le même produit ne peut pas apparaître 2 fois dans la même commande
            $table->unique(['commande_id', 'produit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commande_produit');
    }
};
