<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposCodigosUbicacionVivienda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('viviendas', function (Blueprint $table) {
            $table->strin('codigo_comunidad')->nullable();
            $table->string('codigo_provincia')->nullable();
            $table->string('codigo_localidad')->nullable();
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
            $table->dropColumn('codigo_comunidad');
            $table->dropColumn('codigo_provincia');
            $table->dropColumn('codigo_localidad');
        });
    }
}
