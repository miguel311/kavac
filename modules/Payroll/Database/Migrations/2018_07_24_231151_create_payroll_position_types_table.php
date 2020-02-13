<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @class CreatePositionTypesTable
 * @brief Crear tabla de tipos de cargos
 *
 * Gestiona la creación o eliminación de la tabla de tipos de cargos
 *
 * @author William Páez <wpaez@cenditel.gob.ve>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */
class CreatePayrollPositionTypesTable extends Migration
{
    /**
     * Método que ejecuta las migraciones
     *
     * @author William Páez <wpaez@cenditel.gob.ve>
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('payroll_position_types')) {
            Schema::create('payroll_position_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 100)->comment('Nombre del tipo de cargo');
                $table->string('description', 200)->nullable()->comment('Descripción del tipo de cargo');
                $table->timestamps();
                $table->softDeletes()->comment('Fecha y hora en la que el registro fue eliminado');
            });
        }
    }

    /**
     * Método que elimina las migraciones
     *
     * @author William Páez <wpaez@cenditel.gob.ve>
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_position_types');
    }
}
