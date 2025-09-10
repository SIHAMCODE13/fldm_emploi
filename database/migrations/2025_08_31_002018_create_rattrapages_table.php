<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rattrapages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID de l'utilisateur (enseignant)
            $table->date('date');
            $table->string('periode');
            $table->string('type_seance');
            $table->string('module');
            $table->string('groupe');
            $table->string('statut')->default('en_attente');
            $table->string('salle_attribuee')->nullable();
            $table->text('raison_refus')->nullable();
            $table->timestamps();

            // Clé étrangère vers la table users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rattrapages');
    }
};