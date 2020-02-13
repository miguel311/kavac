<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldParentIdToAccountingAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_accounts', function (Blueprint $table) {
            $table->bigInteger('parent_id')->nullable()->unsigned()
                      ->comment('Identificador asociado a la cuenta padre');
            $table->foreign('parent_id')->references('id')->on('accounting_accounts')->onUpdate('cascade')->comment('Identificador asociado a la cuenta padre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_accounts', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
}
