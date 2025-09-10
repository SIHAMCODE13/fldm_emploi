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
        Schema::create('groupe_modele', function (Blueprint $table) {
            $table->unsignedBigInteger('id_module');
            $table->unsignedBigInteger('id_groupe');

            // Optionnel : définir une clé primaire composite
            $table->primary(['id_module', 'id_groupe']);

            // Clés étrangères (si les tables `modules` et `groupes` existent)
            // $table->foreign('id_module')->references('id_module')->on('modules')->onDelete('cascade');
            // $table->foreign('id_groupe')->references('id_groupe')->on('groupes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_modele');
    }
};
