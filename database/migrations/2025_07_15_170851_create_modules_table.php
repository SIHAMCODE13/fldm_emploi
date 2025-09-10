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
        Schema::create('modules', function (Blueprint $table) {
            $table->id('id_module'); // Clé primaire auto-incrémentée
            $table->string('nom_module')->nullable(); // varchar par défaut (255 caractères)

            // $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('id_filiere')->nullable();
            $table->timestamps(); // Ajoute created_at et updated_at



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
