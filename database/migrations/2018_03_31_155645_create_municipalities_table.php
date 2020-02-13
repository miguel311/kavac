<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('municipalities')) {
            Schema::create('municipalities', function (Blueprint $table) {
                $table->bigIncrements('id')->comment('Identificador único del registro');
                $table->string('name', 100)->comment('Nombre del Municipio');
                $table->string('code', 10)->nullable()->comment('Código que identifica al Municipio');
                $table->bigInteger('estate_id')->unsigned()
                      ->comment('Identificador al Estado al que pertenece el Municipio');
                $table->foreign('estate_id')->references('id')->on('estates')
                      ->onDelete('restrict')->onUpdate('cascade');
                $table->timestamps();
                $table->softDeletes()->comment('Fecha y hora en la que el registro fue eliminado');
                $table->unique(['estate_id', 'name'])->comment('Clave única para el registro');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
}
