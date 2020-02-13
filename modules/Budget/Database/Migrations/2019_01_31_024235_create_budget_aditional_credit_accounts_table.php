<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetAditionalCreditAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_aditional_credit_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount', 30, 10)->comment('Monto asignado a la cuenta presupuestaria');
            $table->bigInteger('budget_sub_specific_formulation_id')->unsigned()->nullable()
                  ->comment('Identificador asociado a la Formulación');
            $table->bigInteger('budget_account_id')->unsigned()->nullable()
                  ->comment('Identificador asociado a la cuenta presupuestaria');
            $table->bigInteger('budget_aditional_credit_id')->unsigned()->nullable()
                  ->comment('Identificador asociado al crédito adicional');
            $table->timestamps();
            $table->softDeletes()->comment('Fecha y hora en la que el registro fue eliminado');
            $table->foreign('budget_sub_specific_formulation_id')->references('id')
                  ->on('budget_sub_specific_formulations')->onUpdate('cascade');
            $table->foreign('budget_account_id')->references('id')
                  ->on('budget_accounts')->onUpdate('cascade');
            $table->foreign('budget_aditional_credit_id')->references('id')
                  ->on('budget_aditional_credits')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_aditional_credit_accounts');
    }
}
