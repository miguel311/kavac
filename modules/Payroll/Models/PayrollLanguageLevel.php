<?php

namespace Modules\Payroll\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use App\Traits\ModelsTrait;

/**
 * @class PayrollLanguageLevel
 * @brief Datos de niveles de idioma
 *
 * Gestiona el modelo de niveles de idioma
 *
 * @author William Páez <wpaez@cenditel.gob.ve>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */
class PayrollLanguageLevel extends Model implements Auditable
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
        'name'
    ];

    /**
     * Método que obtiene los niveles de idioma que está asociados a muchas informaciones profesionales del trabajador
     *
     * @author William Páez <wpaezs@cenditel.gob.ve>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function payrollProfessionalInformations()
    {
        return $this->belongsToMany(
            PayrollProfessionalInformation::class,
            'payroll_language_language_level_professional',
            'payroll_language_level_id',
            'payroll_professional_information_id'
        )->withPivot('payroll_language_id')->withTimestamps();
    }

    /**
     * Método que obtiene
     *
     * @author William Páez <wpaezs@cenditel.gob.ve>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function payrollLanguages()
    {
        return $this->belongsToMany(
            PayrollLanguage::class,
            'payroll_language_language_level_professional',
            'payroll_language_level_id',
            'payroll_language_id'
        )->withPivot('payroll_professional_information_id')->withTimestamps();
    }
}
