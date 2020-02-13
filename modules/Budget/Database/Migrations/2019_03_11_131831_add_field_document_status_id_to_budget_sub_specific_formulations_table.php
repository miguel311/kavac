<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldDocumentStatusIdToBudgetSubSpecificFormulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budget_sub_specific_formulations', function (Blueprint $table) {
            $table->bigInteger('document_status_id')->unsigned()->nullable()
                  ->comment('Identificador asociado a la institución');
            $table->foreign('document_status_id')->references('id')->on('document_status')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_sub_specific_formulations', function (Blueprint $table) {
            $table->dropForeign('budget_sub_specific_formulations_document_status_id_foreign');
            $table->dropColumn('document_status_id');
        });
    }
}
