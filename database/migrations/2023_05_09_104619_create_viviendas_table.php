<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViviendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('perfil_id')
                ->references('id')
                ->on('perfiles');
            $table->string('localidad');
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('puerta')->nullable();
            $table->integer('habitaciones');
            $table->integer('baños');
            $table->integer('compañeros');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viviendas');
    }
}
