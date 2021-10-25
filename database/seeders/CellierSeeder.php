<?php

namespace Database\Seeders;

use App\Models\Cellier;
use Illuminate\Database\Seeder;

class CellierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cellier::create([
            "nom"         => "maison",
            "description" => "Cellier au sous-sol de la maison",
            "user_id"     => 1,
        ]);
    }
}
