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
        Schema::create('groupe_users', function (Blueprint $table) {
            $table->year('annee_scolaire');
            $table->unsignedBigInteger('id_groupe');
            $table->unsignedBigInteger('id_users');

            // Clé primaire composite pour éviter les doublons
            $table->primary(['annee_scolaire', 'id_groupe', 'id_users']);

            // Clés étrangères (facultatif mais recommandé si les tables existent)
            // $table->foreign('id_groupe')->references('id_groupe')->on('groupes')->onDelete('cascade');
            // $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_users');
    }
};
