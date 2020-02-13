<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('documents')) {
            Schema::create('documents', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('code', 20)->unique()
                      ->comment('Código autogenerado para identificar al documento');
                $table->string('file')->comment('Nombre del archivo');
                $table->string('url')->comment('URL del documento');
                $table->json('signs')->nullable()->comment('Firma(s) del documento en JSON');
                $table->morphs('documentable');
                $table->timestamps();
                $table->softDeletes()->comment('Fecha y hora en la que el registro fue eliminado');
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
        Schema::dropIfExists('documents');
    }
}
