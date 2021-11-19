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

        $quantite = DB::table('cellier_bouteilles')
        ->select('quantite')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime','like' ,$millesime . "%")
        ->get();

        if($quantite[0]->quantite + $modificationQuantite >= 0){
            DB::table('cellier_bouteilles')
            ->where('cellier_id', $idCellier)
            ->where('bouteille_id', $idBouteille)
            ->where('millesime','like' ,$millesime . "%")
            ->increment('quantite', $modificationQuantite);
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
        ->where('millesime','like' ,$millesime . "%")
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
        ->select('pays', 'type', 'millesime', 'taille', 'bouteilles.nom', 'quantite', 'url_img', 'cellier_id', 'bouteille_id', 'note','prix', 'date_achat', 'commentaire', 'garde_jusqua')
        ->where('cellier_id', $idCellier)
        ->join('bouteilles', 'bouteilles.id', '=', 'cellier_bouteilles.bouteille_id')
        ->join('types', 'types.id', '=', 'bouteilles.type_id')
        ->join('formats', 'formats.id', '=', 'bouteilles.format_id')
        ->orderBy('bouteilles.id')
        ->get();
    }
    
    /**
     * @param idCellier
     * Obtenir une liste des id des bouteilles équivalent à idCellier
     * @return rows des lignes de la table cellier_bouteilles équivalent à idCellier avec seulement le champ ID
     */
    public static function getCellierBouteillesIDs($idCellier)
    {


        return DB::table('cellier_bouteilles')
        ->select('bouteille_id')
        ->where('cellier_id', $idCellier)
        ->groupBy('bouteille_id')
        ->get();
    }

/**
     * @param idCellier
     * Obtenir une liste des id des bouteilles équivalent à idCellier
     * @return rows des lignes de la table cellier_bouteilles équivalent à idCellier avec seulement le champ ID
     */
    public static function getDataCellierBouteillesByID($idCellier, $idBouteille)
    {


        return DB::table('cellier_bouteilles')
        ->select('millesime', 'quantite', 'note')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->get();
    }



     /**
      *@param idCellier
     * @param idBouteille
     * @param millesime
     * @param note
     * ajouter une note de dégustation à une bouteille
     */
    public static function ajouterNote($idCellier, $idBouteille, $millesime, $note)
    {     
         DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime','like' ,$millesime . "%")
        ->update(['note' => $note]);

    }

 /**
      *@param idCellier
     * @param idBouteille
     * @param millesime
     * @param quantite
     * @param date_achat
     * @param commentaire
     * @param garde_jusqua
     * modifier les informtions dans la table cellier_bouteilles
     */
    public static function modifierCellierBouteille($idCellier, $idBouteille, $millesime, $prix, $quantite, $date_achat, $commentaire=null, $garde_jusqua=null)
    {
         DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime','like' ,$millesime . "%")
        ->update(['prix' => $prix,
                    'quantite'=> $quantite,
                    'commentaire'=>$commentaire,
                    'garde_jusqua'=>$garde_jusqua,
                    'date_achat'=>$date_achat,
                ]);

    }

    public static function suprimerCellierBouteille($idCellier, $idBouteille, $millesime)
    {
        
        DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime','like' ,$millesime . "%")
        ->delete();
    }

}
