<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['client', 'estheticienne', 'admin'])
                  ->default('client')
                  ->after('email');

            $table->string('telephone', 20)->nullable()->after('role');
            $table->string('photo')->nullable()->after('telephone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'telephone', 'photo']);
        });
    }
};
