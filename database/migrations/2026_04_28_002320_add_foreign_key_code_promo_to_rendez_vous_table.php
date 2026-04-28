<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rendez_vous', function (Blueprint $table) {
            // Ajouter la contrainte FK sur la colonne existante
            $table->foreign('code_promo_id')
                  ->references('id')
                  ->on('codes_promo')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('rendez_vous', function (Blueprint $table) {
            $table->dropForeign(['code_promo_id']);
        });
    }
};
