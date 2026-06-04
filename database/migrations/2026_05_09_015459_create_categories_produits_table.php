<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories_produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100)->unique();
            $table->string('description')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });

        Schema::table('produits', function (Blueprint $table) {
            $table->foreignId('categorie_id')
                  ->nullable()
                  ->after('nom')
                  ->constrained('categories_produits')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropForeign(['categorie_id']);
            $table->dropColumn('categorie_id');
        });
        Schema::dropIfExists('categories_produits');
    }
};
