<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Modifier l'enum statut_compte pour ajouter "supprime"
        DB::statement("ALTER TABLE users MODIFY COLUMN statut_compte
                       ENUM('actif', 'en_attente_validation', 'desactive', 'bloque', 'supprime')
                       NOT NULL DEFAULT 'actif'");

        // 2. Ajouter une date à partir de laquelle l'email redevient utilisable
        // - NULL = email libre tout de suite (pas de blocage)
        // - Date future = email réservé jusqu'à cette date (cas auto-suppression : +1 mois)
        // - Date 9999-12-31 = email banni à vie (cas blocage/suppression admin)
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('email_libre_le')->nullable()->after('motif_statut');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_libre_le');
        });

        DB::statement("ALTER TABLE users MODIFY COLUMN statut_compte
                       ENUM('actif', 'en_attente_validation', 'desactive', 'bloque')
                       NOT NULL DEFAULT 'actif'");
    }
};
