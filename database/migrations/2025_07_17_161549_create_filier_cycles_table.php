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
        Schema::create('filier_cycles', function (Blueprint $table) {
            $table->unsignedInteger('id_filiere');
            $table->unsignedBigInteger('id_cycle');
            $table->primary(['id_filiere', 'id_cycle']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filier_cycles');
    }
};
