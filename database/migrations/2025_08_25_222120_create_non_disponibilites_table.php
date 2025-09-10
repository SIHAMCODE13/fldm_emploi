<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonDisponibilitesTable extends Migration
{
    public function up()
    {
        Schema::create('non_disponibilites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enseignant_id')->constrained('users')->onDelete('cascade');
            $table->date('date_debut'); // Date de début de l'indisponibilité
            $table->date('date_fin')->nullable(); // Date de fin (pour les périodes)
            $table->string('type_periode'); // 'journee' ou 'periode'
            $table->string('periode')->nullable(); // Ex: '8h-10h' (si type_periode = 'periode')
            $table->text('raison');
            $table->string('statut')->default('en_attente'); // en_attente, approuve, rejete
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('non_disponibilites');
    }
}