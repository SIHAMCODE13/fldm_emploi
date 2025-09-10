<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJourFeriesTableAddDateDebutAndDateFin extends Migration
{
    public function up()
    {
        Schema::table('jour_feries', function (Blueprint $table) {
            $table->dropColumn('date_ferie');
            $table->date('date_debut')->nullable()->after('id_jour_ferie');
            $table->date('date_fin')->nullable()->after('date_debut');
        });
    }

    public function down()
    {
        Schema::table('jour_feries', function (Blueprint $table) {
            $table->dropColumn(['date_debut', 'date_fin']);
            $table->date('date_ferie')->nullable()->after('id_jour_ferie');
        });
    }
}
