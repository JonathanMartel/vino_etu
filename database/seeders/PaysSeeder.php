<?php

namespace Database\Seeders;

use App\Models\Pays;
use Illuminate\Database\Seeder;

class PaysSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $pays = [
            [
                "nom" => "Italie",
            ],
            [
                "nom" => "France",
            ],
            [
                "nom" => "Afrique du Sud",
            ],
            [
                "nom" => "Canada",
            ],
            [
                "nom" => "Portugal",
            ],
            [
                "nom" => "États-Unis",
            ],
        ];

        foreach($pays as $unPays) {
            Pays::create($unPays);
        }
    }
}
