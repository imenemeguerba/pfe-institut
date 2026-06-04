<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modifier l'ENUM pour ajouter 'reporte'
        DB::statement("
            ALTER TABLE rendez_vous
            MODIFY COLUMN statut ENUM(
                'en_attente',
                'confirme',
                'refuse',
                'annule',
                'termine',
                'reporte'
            ) NOT NULL DEFAULT 'en_attente'
        ");

        // Ajouter la colonne motif_report si elle n'existe pas
        DB::statement("
            ALTER TABLE rendez_vous
            ADD COLUMN IF NOT EXISTS motif_report TEXT NULL AFTER motif_refus
        ");
    }

    public function down(): void
    {
        // Supprimer motif_report
        DB::statement("
            ALTER TABLE rendez_vous
            DROP COLUMN IF EXISTS motif_report
        ");

        // Remettre l'ENUM sans 'reporte'
        DB::statement("
            ALTER TABLE rendez_vous
            MODIFY COLUMN statut ENUM(
                'en_attente',
                'confirme',
                'refuse',
                'annule',
                'termine'
            ) NOT NULL DEFAULT 'en_attente'
        ");
    }
};
