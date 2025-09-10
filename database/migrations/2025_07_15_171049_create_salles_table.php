<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salles', function (Blueprint $table) {
            $table->id('id_salle'); // Clé primaire auto-incrémentée
            $table->string('nom_salle', 100)->nullable();
            $table->integer('capacite')->nullable();
            $table->boolean('disponibilite')->nullable();
            $table->timestamps(); // This adds both created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salles');
    }
};