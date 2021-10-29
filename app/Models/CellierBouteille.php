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

    /**
     * Ajouter ou diminuer la quantité d'une bouteille dans un cellier
     */
    public static function modifierQuantiteBouteille($idCellier, $idBouteille, $millesime, $modificationQuantite){

        if($millesime == 0) {
            $millesime = 0000;
        }

        $quantite = DB::table('cellier_bouteilles')
        ->select('quantite')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->get();
     //   if($quantite[0]->quantite !=0){
        DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->increment('quantite', $modificationQuantite);
       // }
     
         return true ;
    }


    /**
     * Ajouter ou diminuer la quantité d'une bouteille dans un cellier
     */
    public static function supprimerQuantiteBouteille($idCellier, $idBouteille, $millesime, $modificationQuantite){

        if($millesime == 0) {
            $millesime = 0000;
        }

        $quantite = DB::table('cellier_bouteilles')
        ->select('quantite')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->get();
        if($quantite[0]->quantite !=0){
        DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->decrement('quantite', 1);
        }
     
         return true ;
    }

    /**
     * @param idCellier
     * @param idBouteille
     * @param millesime
     * Vérifier si une bouteille existe déjà dans le cellier
     * @return row une ligne de la table cellier_bouteilles
     */
    public static function rechercheCellierBouteille($idCellier, $idBouteille, $millesime) {
        return DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->get();
    }

    /**
     * @param idCellier
     * @param idBouteille
     * Obtenir une liste des millisimes équivalent à idCellier et idBouteille
     * @return rows des lignes de la table cellier_bouteilles équivalent à idCellier et idBouteille 
     */
    public static function obtenirMillesimesParBouteille($idCellier, $idBouteille)
    {
        return DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->get();
    }
    
    /**
     * @param idCellier
     * Obtenir une liste des bouteilles équivalent à idCellier
     * @return rows des lignes de la table cellier_bouteilles équivalent à idCellier
     */
    public static function obtenirListeBouteilleCellier($idCellier)
    {
        return DB::table('cellier_bouteilles')
        ->select('pays', 'type', 'millesime', 'taille', 'bouteilles.nom', 'quantite', 'url_img', 'cellier_id', 'bouteille_id' )
        ->where('cellier_id', $idCellier)
        ->join('bouteilles', 'bouteilles.id', '=', 'cellier_bouteilles.bouteille_id')
        ->join('types', 'types.id', '=', 'bouteilles.type_id')
        ->join('formats', 'formats.id', '=', 'bouteilles.format_id')
        ->get();
    }
    
}
