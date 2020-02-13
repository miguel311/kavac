<?php

namespace Modules\Asset\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Asset\Models\AssetUseFunction;

/**
 * @class AssetUseFunctionsTableSeeder
 * @brief Inicializar Funciones de uso de los bienes
 *
 *
 * @author Henry Paredes <hparedes@cenditel.gob.ve>
 * @license <a href='http://conocimientolibre.cenditel.gob.ve/licencia-de-software-v-1-3/'>
 *              LICENCIA DE SOFTWARE CENDITEL
 *          </a>
 */

class AssetUseFunctionsTableSeeder extends Seeder
{
    /**
     * Método que registra los valores iniciales de las funciones de uso de un bien
     *
     * @author  Henry Paredes <hparedes@cenditel.gob.ve>
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $asset_use_functions = [
            ['name' => 'Residencial'],
            ['name' => 'Agrícola'],
            ['name' => 'Turístico'],
            ['name' => 'Comercial'],
            ['name' => 'Educativo'],
            ['name' => 'Asistencial'],
            ['name' => 'De oficina'],
            ['name' => 'Industrial']

        ];


           
        foreach ($asset_use_functions as $asset_use_function) {
            AssetUseFunction::updateOrCreate(
                ['name' => $asset_use_function['name']]
            );
        }
    }
}
