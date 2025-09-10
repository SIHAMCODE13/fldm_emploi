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
        Schema::create('jour_feries', function (Blueprint $table) {
            $table->id('id_jour_ferie'); // clé primaire auto-incrémentée
            $table->date('date_ferie')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps(); // Ajoute created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jour_feries');
    }
};
