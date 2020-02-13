<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @class CreateStaffClassificationsTable
 * @brief Crear tabla de clasificación del personal
 *
 * Gestiona la creación o eliminación de la tabla de clasificación del personal
 *
 * @author William Páez <wpaez@cenditel.gob.ve>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */
class CreatePayrollStaffClassificationsTable extends Migration
{
    /**
     * Método que ejecuta las migraciones
     *
     * @author William Páez <wpaez@cenditel.gob.ve>
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('payroll_staff_classifications')) {
            Schema::create('payroll_staff_classifications', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 100)->comment('Nombre de la clasificación del personal');
                $table->string('description', 200)->nullable()->comment('Descripción de la clasificación del personal');
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
        Schema::dropIfExists('payroll_staff_classifications');
    }
}
