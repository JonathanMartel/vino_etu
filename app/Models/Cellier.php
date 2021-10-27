<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellier extends Model
{
    use HasFactory;

    public function bouteilles() {
        return $this->belongsToMany(Bouteille::class, "celliers_bouteilles", "celliers_id", "bouteilles_id")->withPivot(["inventaire"]);
    }
}
