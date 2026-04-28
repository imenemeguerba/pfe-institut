<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panier_produit', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('panier_id')
                  ->constrained('paniers')
                  ->onDelete('cascade');

            $table->foreignId('produit_id')
                  ->constrained('produits')
                  ->onDelete('cascade');

            // Quantité du produit dans le panier
            $table->integer('quantite')->default(1);

            $table->timestamps();

            // Le même produit ne peut pas apparaître 2 fois dans le même panier
            // (on incrémente la quantité au lieu de créer une 2ème ligne)
            $table->unique(['panier_id', 'produit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panier_produit');
    }
};
