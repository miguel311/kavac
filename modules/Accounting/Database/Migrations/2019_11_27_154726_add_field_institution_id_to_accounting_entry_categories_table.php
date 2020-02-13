<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInstitutionIdToAccountingEntryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'accounting_entry_categories',
            function (Blueprint $table) {
                if (!Schema::hasColumn('accounting_entry_categories', 'institution_id')) {
                    $table->bigInteger('institution_id')->unsigned()->nullable()
                    ->comment('id de la institucion a relacionar con el registro');

                    $table->foreign('institution_id')->references('id')->on('currencies')
                    ->onDelete('cascade')->comment('id de la institucion a relacionar con el registro');
                }
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'accounting_entry_categories',
            function (Blueprint $table) {
                if (Schema::hasColumn('accounting_entry_categories', 'institution_id')) {
                    $table->dropColumn('institution_id');
                }
            }
        );
    }
}
