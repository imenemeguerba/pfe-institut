<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('conseils_beaute', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->string('type_peau'); // normale|grasse|seche|mixte|sensible|tous
            $table->string('categorie'); // routine_matin|routine_soir|ingredients|eviter|conseil_general
            $table->string('emoji')->nullable(); // 🌿💧🌵☯️🌸
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('conseils_beaute');
    }
};
