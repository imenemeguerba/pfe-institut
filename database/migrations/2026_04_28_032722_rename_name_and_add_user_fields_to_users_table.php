<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Renommer 'name' en 'nom'
            $table->renameColumn('name', 'nom');
        });

        Schema::table('users', function (Blueprint $table) {
            // Ajouter les nouveaux champs
            $table->string('prenom', 100)->nullable()->after('nom');
            $table->date('date_naissance')->nullable()->after('telephone');
            $table->integer('experience')->nullable()->after('date_naissance');
            $table->text('bio')->nullable()->after('experience');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'date_naissance', 'experience', 'bio']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nom', 'name');
        });
    }
};
