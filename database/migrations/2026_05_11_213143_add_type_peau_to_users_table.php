<?php
// ════════════════════════════════════════════════════════════
// MIGRATION 1 : add_type_peau_to_users_table
// Commande: php artisan make:migration add_type_peau_to_users_table
// ════════════════════════════════════════════════════════════

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('type_peau')->nullable()->after('bio');
            // valeurs: normale | grasse | seche | mixte | sensible
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type_peau');
        });
    }
};
