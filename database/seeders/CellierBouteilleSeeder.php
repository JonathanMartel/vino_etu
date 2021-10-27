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
                "cellier_id"   => 1,
                "bouteille_id" => 45,
                "inventaire"   => 2
            ],
            [
                "cellier_id"   => 1,
                "bouteille_id" => 78,
                "inventaire"   => 1
            ],
            [
                "cellier_id"   => 1,
                "bouteille_id" => 2,
                "inventaire"   => 1
            ],
            [
                "cellier_id"   => 1,
                "bouteille_id" => 136,
                "inventaire"   => 3
            ],
        ];

        foreach ($cellierBouteilles as $bouteille) {
            CellierBouteille::create($bouteille);
        }
    }
}
