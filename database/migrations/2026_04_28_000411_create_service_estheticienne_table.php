<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_estheticienne', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('cascade');

            $table->foreignId('estheticienne_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();

            // Empêche le doublon (la même esthe ne peut pas avoir le même service 2 fois)
            $table->unique(['service_id', 'estheticienne_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_estheticienne');
    }
};
