<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fidelite_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->integer('points'); // positif = gain, négatif = utilisation
            $table->string('type'); // 'rdv' | 'commande' | 'bonus'
            $table->string('description');
            $table->nullableMorphs('source'); // lien vers RDV ou Commande
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('fidelite_points');
    }
};
