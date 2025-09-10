<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeancesTable extends Migration
{
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id('id_seance');
            $table->string('jour');
            $table->time('debut');
            $table->time('fin');
            $table->string('type_seance');
            $table->unsignedBigInteger('id_salle');
            $table->unsignedBigInteger('id_module');
            $table->unsignedBigInteger('id_groupe');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seances');
    }
}

;
