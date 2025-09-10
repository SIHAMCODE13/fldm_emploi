<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSemestreToSeancesTable extends Migration
{
    public function up()
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->unsignedBigInteger('id_semestre')->nullable()->after('id_filiere'); // champ virtuel
        });
    }

    public function down()
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->dropColumn('id_semestre');
        });
    }
}
