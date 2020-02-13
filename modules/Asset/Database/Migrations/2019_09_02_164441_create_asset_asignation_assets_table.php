<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @class CreateAssetAsignationAssetsTable
 * @brief Crear tabla de los bienes institucionales asignados
 *
 * Gestiona la creación o eliminación de la tabla de bienes institucionales asociados a una asignación
 *
 * @author Henry Paredes <hparedes@cenditel.gob.ve>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */
class CreateAssetAsignationAssetsTable extends Migration
{
    /**
     * Método que ejecuta las migraciones
     *
     * @author Henry Paredes <hparedes@cenditel.gob.ve>
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('asset_asignation_assets')) {
            Schema::create('asset_asignation_assets', function (Blueprint $table) {
                $table->bigIncrements('id')->comment('Identificador único del registro');

                $table->bigInteger('asset_id')->unsigned()->nullable()
                      ->comment('Identificador único del bien en la tabla de bienes');
                $table->foreign('asset_id')->references('id')->on('assets')->onDelete('restrict')->onUpdate('cascade');

                $table->bigInteger('asset_asignation_id')->unsigned()->nullable()
                      ->comment('Identificador único de la asignación generada');
                $table->foreign('asset_asignation_id')->references('id')->on('asset_asignations')
                      ->onDelete('restrict')->onUpdate('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Método que elimina las migraciones
     *
     * @author Henry Paredes <hparedes@cenditel.gob.ve>
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_asignation_assets');
    }
}
