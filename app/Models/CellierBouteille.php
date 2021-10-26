<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CellierBouteille extends Model
{
    use HasFactory;

    protected $fillable = ['garde_jusqua', 'date_achat', 'note', 'commentaire', 'prix', 'quantite', 'millesime','cellier_id', 'bouteille_id'];

    /**
     * Obtenir les informations de la table bouteilles
     */
    public function bouteille()
    {
        return $this->belongsTo(Bouteille::class);
    }

    public static function modifierQuantiteBouteille($idCellier, $idBouteille, $millesime, $modificationQuantite){
        
        DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->increment('quantite', $modificationQuantite);
        
         return true;
    }

    public static function rechercheBouteilleExistante($request) {
        return DB::table('bouteilles')
        
        ->where('id', $request->bouteille_id)
        ->where('nom', $request->nom)
        ->where('pays', $request->pays)
       ->where('type_id', $request->type_id)
        ->where('format_id', $request->format_id)
        ->whereIn("user_id",  [1, 2])
        ->get();
    }

    public static function rechercheCellierBouteille($idCellier, $idBouteille, $millesime) {
        return DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->get();
    }
}
