<?php

namespace Modules\Payroll\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use App\Traits\ModelsTrait;

/**
 * @class PayrollInstructionDegree
 * @brief Datos de grado de instrucción
 *
 * Gestiona el modelo de grados de instruccíón
 *
 * @author William Páez <wpaez@cenditel.gob.ve>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */
class PayrollInstructionDegree extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;
    use ModelsTrait;

    /**
     * Lista de atributos para la gestión de fechas
     * @var array $dates
     */
    protected $dates = ['deleted_at'];

    /**
     * Lista de atributos que pueden ser asignados masivamente
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * Método que obtiene el grado de instrucción asociado a muchas informaciones profesionales del trabajador
     *
     * @author William Páez <wpaez@cenditel.gob.ve>
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payrollProfessionalInformations()
    {
        return $this->hasMany(PayrollProfessionalInformation::class);
    }

    /**
     * Método que obtiene los requerimientos de las escalas asociados a un grado de instrucción
     *
     * @author Henry Paredes <hparedes@cenditel.gob.ve>
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function payrollScaleRequirements()
    {
        return $this->morphMany(PayrollScale::class, 'clasificable');
    }
}
