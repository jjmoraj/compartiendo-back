<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NuevosCamposPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perfiles', function (Blueprint $table) {
            $table->string('comunidad')->nullable();
            $table->string('provincia')->nullable();
            $table->boolean('fumador');
            $table->integer('edad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perfiles', function (Blueprint $table) {
            $table->dropColumn('comunidad');
            $table->dropColumn('provincia');
            $table->dropColumn('fumador');
            $table->dropColumn('edad');
        });
    }
}
