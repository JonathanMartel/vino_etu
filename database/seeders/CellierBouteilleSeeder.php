<?php

namespace Database\Seeders;

use App\Models\CellierBouteille;
use Illuminate\Database\Seeder;

class CellierBouteilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cellierBouteilles = [
            [
                "celliers_id"   => 1,
                "bouteilles_id" => 45,
                "inventaire"   => 2
            ],
            [
                "celliers_id"   => 1,
                "bouteilles_id" => 78,
                "inventaire"   => 1
            ],
            [
                "celliers_id"   => 1,
                "bouteilles_id" => 2,
                "inventaire"   => 1
            ],
            [
                "celliers_id"   => 1,
                "bouteilles_id" => 33,
                "inventaire"   => 3
            ],
        ];

        foreach ($cellierBouteilles as $bouteille) {
            CellierBouteille::create($bouteille);
        }
    }
}
