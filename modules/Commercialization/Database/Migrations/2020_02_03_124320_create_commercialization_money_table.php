<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercializationMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercialization_money', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Identificador único del registro');
            $table->string('money_type', 100)->comment('Simbolo de Moneda a Facturar');
            $table->string('exchange_rate', 100)->comment('Tasa cambiaria');
            $table->string('name_money', 100)->comment('Nombre de la moneda');
            $table->timestamps();
            $table->softDeletes()->comment('Fecha y hora en la que el registro fue eliminado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercialization_money');
    }
}
