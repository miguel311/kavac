<?php

namespace Modules\Payroll\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Payroll\Models\PayrollStudyType;

/**
 * @class PayrollStudyTypesTableSeeder
 * @brief Inicializar los tipos de estudio
 *
 *
 * @author William Páez <wpaez@cenditel.gob.ve>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */
class PayrollStudyTypesTableSeeder extends Seeder
{
    /**
     * Método que registra los valores de los tipos de estudio
     *
     * @author  William Páez <wpaez@cenditel.gob.ve>
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $payrollStudyTypes = [
            [
                'name' => 'Pregrado', 'description' => null
            ],
            [
                'name' => 'Postgrado', 'description' => null
            ],
            [
                'name' => 'Doctorado', 'description' => null
            ]
        ];

        DB::transaction(function () use ($payrollStudyTypes) {
            foreach ($payrollStudyTypes as $payrollStudyType) {
                PayrollStudyType::updateOrCreate(
                    ['name' => $payrollStudyType['name']],
                    [
                        'description' => $payrollStudyType['description']
                    ]
                );
            }
        });
    }
}
