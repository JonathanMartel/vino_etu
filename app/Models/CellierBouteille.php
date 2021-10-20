<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CellierBouteille extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['garde_jusqua', 'date_achat', 'note', 'commentaire', 'prix', 'quantite', 'millesime','cellier_id', 'bouteille_id'];

    public function bouteille()
    {
        return $this->belongsTo(Bouteille::class);
    }

    public static function selectCellierBouteille($idCellier, $idBouteille){
        return CellierBouteille::select('*')
            ->where('bouteille_id', $idBouteille)
            ->where("cellier_id", $idCellier)
            ->first();

    }
}
