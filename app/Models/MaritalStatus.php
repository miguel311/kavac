<?php

/** Modelos generales de base de datos */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use App\Traits\ModelsTrait;

use Module;

/**
 * @class MaritalStatus
 * @brief Datos de los estados civiles
 *
 * Gestiona el modelo de datos para los estados civiles
 *
 * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */
class MaritalStatus extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;
    use ModelsTrait;

    /**
     * Nombre de la tabla a usar en la base de datos
     * @var string $table
     */
    protected $table = 'marital_status';

    /**
     * Lista de atributos para la gestión de fechas
     * @var array $dates
     */
    protected $dates = ['deleted_at'];

    /**
     * Lista de atributos que pueden ser asignados masivamente
     * @var array $fillable
     */
    protected $fillable = ['name'];

    /**
     * MaritalStatus has many PayrollStaff.
     *
     * @return array|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payrolls()
    {
        return (Module::has('Payroll'))?$this->hasMany(\Modules\Payroll\Models\PayrollStaff::class):[];
    }
}
