<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('panier_produit', function (Blueprint $table) {
            $table->foreignId('variante_id')
                  ->nullable()
                  ->after('produit_id')
                  ->constrained('produit_variantes')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('panier_produit', function (Blueprint $table) {
            $table->dropForeign(['variante_id']);
            $table->dropColumn('variante_id');
        });
    }
};