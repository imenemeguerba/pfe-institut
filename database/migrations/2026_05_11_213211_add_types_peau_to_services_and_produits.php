<?php
// ════════════════════════════════════════════════════════════
// MIGRATION 2 : add_types_peau_to_services_and_produits
// Commande: php artisan make:migration add_types_peau_to_services_and_produits
// ════════════════════════════════════════════════════════════

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('services', function (Blueprint $table) {
            $table->json('types_peau')->nullable()->after('actif');
            // ex: ["normale","grasse"] ou null = convient à tous
        });
        Schema::table('produits', function (Blueprint $table) {
            $table->json('types_peau')->nullable()->after('actif');
        });
    }
    public function down(): void {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('types_peau');
        });
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn('types_peau');
        });
    }
};
