<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdFiliereToSeancesTable extends Migration
{
    public function up()
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->unsignedBigInteger('id_filiere')->nullable()->after('id_seance');
        });
    }

    public function down()
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->dropColumn('id_filiere');
        });
    }
}
