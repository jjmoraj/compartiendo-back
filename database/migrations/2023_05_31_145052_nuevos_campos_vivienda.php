<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NuevosCamposVivienda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('viviendas', function (Blueprint $table) {
            $table->string('comunidad');
            $table->string('provincia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('viviendas', function (Blueprint $table) {
            $table->dropColumn('comunidad');
            $table->dropColumn('provincia');
        });
    }
}
