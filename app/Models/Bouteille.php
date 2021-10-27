<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille extends Model
{
    use HasFactory;

    public function celliers() {
        return $this->belongsToMany(Cellier::class, "celliers_bouteilles")->withPivot("inventaire");
    }
}
