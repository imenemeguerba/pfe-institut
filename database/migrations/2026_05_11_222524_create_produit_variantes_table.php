<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produit_variantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
            $table->string('nom'); // ex: "50ml", "100ml", "500ml"
            $table->integer('prix'); // en DA
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('produit_variantes');
    }
};
