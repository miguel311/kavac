<?php

namespace Modules\Commercialization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Commercialization\Models\CommercializationMoney;

class CommercializationMoneyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Moneda estandar */
        $moneda = new CommercializationMoney();
        $moneda->id = 1; 
        $moneda->money_type = "BsS"; 
        $moneda->exchange_rate = "1"; 
        $moneda->name_money = "Bolívar Soberano"; 
        $moneda->save();
    }
}
