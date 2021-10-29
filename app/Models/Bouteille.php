<?php

namespace App\Models;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bouteille extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nom', 'code_saq', 'pays', 'description', 'prix_saq', 'url_saq', 'url_img', 'format_id', 'type_id', 'user_id'];

    /**
     * Obtenir les informations de la table types
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * @param motCle
     * Rechercher dans la table bouteilles les noms qui contiennent le motCle
     * @return rows des lignes de la table bouteilles
     */
    public static function rechercheBouteillesParMotCle($motCle) {

        return DB::table('bouteilles')
        ->select('nom', 'bouteilles.id', 'pays', 'description', 'type', 'type_id', 'format_id', 'url_img', 'prix_saq' )
        ->where('nom', "LIKE" , "%" .$motCle. "%")
        ->whereIn("user_id", [1, session('user')->id])
        ->join('types', 'bouteilles.type_id', '=', 'types.id')
        ->get();
    }

        /**
     * @param $request
     * Rechercher dans la table bouteilles pour vérifier si une bouteille existe déjà
     * @return row une ligne de la table cellier_bouteilles
     */
    public static function rechercheBouteilleExistante($request) {
        return DB::table('bouteilles')
        ->where('id', $request->bouteille_id)
        ->where('nom', $request->nom)
        ->where('pays', $request->pays)
        ->where('type_id', $request->type_id)
        ->where('format_id', $request->format_id)
        ->whereIn("user_id",  [1, session('user')->id])
        ->get();
        
    }
}
