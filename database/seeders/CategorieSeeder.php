<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $categories = [
            [
                "nom" => "Vin blanc",
            ],
            [
                "nom" => "Vin rouge",
            ],
            [
                "nom" => "Spiritueux",
            ],
            [
                "nom" => "Porto et vin fortifié",
            ],
            [
                "nom" => "Saké",
            ]
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}
