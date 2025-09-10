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
        Schema::create('semistres', function (Blueprint $table) {
            $table->id('id_semestre'); // Clé primaire auto-incrémentée
            $table->string('nom_semestre', 100)->nullable(); // varchar(100)
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semistres');
    }
};
