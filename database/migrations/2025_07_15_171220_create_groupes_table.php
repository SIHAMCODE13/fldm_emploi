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
        Schema::create('groupes', function (Blueprint $table) {
            $table->id('id_groupe'); // équivalent à int(11) NOT NULL AUTO_INCREMENT
            $table->string('nom_groupe', 100)->nullable();
            $table->unsignedBigInteger('id_filiere')->nullable();
            $table->unsignedBigInteger('id_semestre')->nullable();
            $table->timestamps();

            // Si vous avez des clés étrangères, vous pouvez les ajouter ainsi :
            // $table->foreign('id_filiere')->references('id')->on('filieres')->onDelete('set null');
            // $table->foreign('id_semestre')->references('id')->on('semestres')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupes');
    }
};
