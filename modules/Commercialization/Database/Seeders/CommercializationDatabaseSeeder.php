<?php

namespace Modules\Commercialization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CommercializationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(CommercializationMoneyTableSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
