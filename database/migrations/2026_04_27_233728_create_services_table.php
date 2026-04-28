<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Foreign key vers categories
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('restrict');

            // Infos de base
            $table->string('nom', 150);
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            // Prix et durée
            $table->integer('prix'); // En DA
            $table->integer('duree'); // En minutes

            // Gestion
            $table->boolean('actif')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
