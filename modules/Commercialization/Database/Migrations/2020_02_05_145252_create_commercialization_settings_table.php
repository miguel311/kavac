<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use App\CommercializationMoney;


class CreateCommercializationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercialization_settings', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Identificador único del registro');
            //Datos para Factura
            $table->string('start_billing_number', 100)->comment('Inicio de Numero de facturación');
            $table->string('end_billing_number', 100)->comment('Fin de Numero de facturación');
            $table->float('iva', 8, 2)->comment('I.V.A. Impuesto del valor agregado');
            $table->string('rif_cedule', 100)->comment('Rif o Cedula del la Facturación');
            $table->string('name_facturation', 100)->comment('Nombre Titular o Razón Social de Facturación');
            //Moneda
            $table->bigInteger('money_id')->unsigned()->comment('Tipo de Moneda a Facturar');
            $table->foreign('money_id')->references('id')->on('commercialization_money');
            //Usuario que Modifica
            $table->bigInteger('user_id')->unsigned()->comment('Usuario que modifica');
            $table->foreign('user_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('commercialization_settings');
    }
}
