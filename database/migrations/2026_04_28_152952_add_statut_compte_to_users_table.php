<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('statut_compte', [
                'actif',
                'en_attente_validation',
                'desactive',
                'bloque',
            ])->default('actif')->after('role');

            // Motif (si bloqué/désactivé) - utile pour expliquer au user
            $table->text('motif_statut')->nullable()->after('statut_compte');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['statut_compte', 'motif_statut']);
        });
    }
};
