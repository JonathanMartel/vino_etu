<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cellier extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'nom', 'localisation', 'user_id'];

    /**
     * Obtenir les informations de la table bouteilles
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param user_id
     * @return celliers tous les celliers apartenant à user_id
     */
    public static function getCelliersByUser($user_id)
    {
        $celliers = DB::table('celliers')
        ->where("user_id", $user_id)
        ->get();
        return $celliers;
    }

    /**
     * https://stackoverflow.com/questions/29548073/laravel-advanced-wheres-how-to-pass-variable-into-function
     * Rechercher dans tous les tables des colonnes qui contiennent le motCle
     * @param motcle
     * @param idCellier
     * @return rows une jointure de tous les tables contenant le mot clé
     */
    public static function rechercheDansCellier($motCle, $idCellier){
        if(strtolower($motCle) == 'non millésimé')
        {
            return DB::table('bouteilles')
            ->select('bouteilles.nom', 'bouteille_id', 'pays', 'description', 'type', 'type_id', 'format_id', 'url_img', 'taille', 'millesime', 'note', 'quantite', 'prix', 'garde_jusqua', 'date_achat', 'url_saq' )
            ->where('cellier_bouteilles.cellier_id', $idCellier)
            ->where('millesime',  $motCle)     
            ->join('cellier_bouteilles', 'bouteilles.id', '=', 'cellier_bouteilles.bouteille_id' )
            ->join('types', 'bouteilles.type_id', '=', 'types.id')
            ->join('formats', 'formats.id', '=', 'bouteilles.format_id')
            ->get();
        } 
        
        return DB::table('bouteilles')
        ->select('bouteilles.nom', 'bouteille_id', 'pays', 'description', 'type', 'type_id', 'format_id', 'url_img', 'taille', 'millesime', 'note', 'quantite', 'prix', 'garde_jusqua', 'date_achat', 'url_saq' )
        ->where('cellier_bouteilles.cellier_id', $idCellier)
        ->where(function($query) use ($motCle){
            $query->where('bouteilles.nom', "LIKE" , "%" .$motCle. "%")
            ->orWhere('type', "LIKE" , "%" .$motCle. "%")
            ->orWhere('millesime', "LIKE" , "%" .$motCle. "%")
            ->orWhere('pays', "LIKE" , "%" .$motCle. "%")
            ->orWhere('prix', "LIKE" , "%" .$motCle. "%")
            ->orWhere('quantite', "LIKE" , "%" .$motCle. "%")
            ->orWhere('garde_jusqua', "LIKE" , "%" .$motCle. "%")
            ->orWhere('note', "LIKE" , "%" .$motCle. "%")
            ->orWhere('date_achat', "LIKE" , "%" .$motCle. "%")
            ->orWhere('description', "LIKE" , "%" .$motCle. "%")
            ->orWhere('taille', "LIKE" , "%" .$motCle. "%");
        })    
        ->join('cellier_bouteilles', 'bouteilles.id', '=', 'cellier_bouteilles.bouteille_id' )
        ->join('types', 'bouteilles.type_id', '=', 'types.id')
        ->join('formats', 'formats.id', '=', 'bouteilles.format_id')      
        ->get();
    
    }

    
}
