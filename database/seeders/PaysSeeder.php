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
            [
                "nom" => "Australie",
            ],
            [
                "nom" => "Espagne",
            ],
            [
                "nom" => "Argentine",
            ],
            [
                "nom" => "Chili",
            ],
            [
                "nom" => "Grèce",
            ],
            [
                "nom" => "Nouvelle-Zélande",
            ],
            [
                "nom" => "Moldavie",
            ],
            [
                "nom" => "Allemagne",
            ],
            [
                "nom" => "Autriche",
            ],
            [
                "nom" => "Hongrie",
            ],
            [
                "nom" => "Arménie",
            ],
        ];

        Pays::insert($pays);
    }
}
