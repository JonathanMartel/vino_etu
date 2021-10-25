<?php

namespace Database\Seeders;

use App\Models\BouteillePersonnalisee;
use Illuminate\Database\Seeder;

class BouteillePersonnaliseeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BouteillePersonnalisee::create([
            "nom" => "Vin de bouette",
            "description" => "Un vin particulièrement exécrable",
            "conservation" => "pas plus qu'une semaine",
            "pays_id" => 5,
            "categories_id" => 2,
            "users_id" => 1,
        ]);
    }
}
