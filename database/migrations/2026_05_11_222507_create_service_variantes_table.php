<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('service_variantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('nom'); // ex: "Court", "Mi-long", "Long"
            $table->integer('prix'); // en DA
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('service_variantes');
    }
};
 