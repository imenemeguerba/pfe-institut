<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rendez_vous', function (Blueprint $table) {
            // Lien entre plusieurs RDVs d'une même réservation splittée
            // null = RDV simple (1 esthe pour tous les services)
            $table->string('groupe_reservation', 36)->nullable()->after('id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('rendez_vous', function (Blueprint $table) {
            $table->dropColumn('groupe_reservation');
        });
    }
};
