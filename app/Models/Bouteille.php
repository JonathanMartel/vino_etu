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
        ->select('bouteilles.nom', 'bouteilles.id', 'pays', 'description', 'type', 'type_id', 'format_id', 'url_img', 'prix_saq', 'taille' )
        ->where('bouteilles.nom', "LIKE" , "%" .$motCle. "%")
        ->whereIn("user_id", [1, session('user')->id])
        ->join('types', 'bouteilles.type_id', '=', 'types.id')
        ->join('formats', 'formats.id', '=', 'bouteilles.format_id')
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

    public static function supprimerDoublons($array)
    {  
        foreach($array as $key => $element) {
     
            $bouteille = DB::table('bouteilles')
            ->where('code_saq', $element->desc->code_SAQ)
            ->get();
           // print_r($bouteille);
            if(!$bouteille->isEmpty()){
                unset($array[$key]);       
            }else {
 
                $idType = DB::table('types')
                ->select('id')
                ->where('type', "LIKE" , "%" . explode(' ', $element->desc->type)[1]. "%")
                ->get();
               print_r($idType);
                if( explode(' ', $element->desc->format)[1] == "L") {
                    $format = explode(' ', str_replace(',', '.', $element->desc->format))[0] * 100;
                   echo $format;
                }else if (explode(' ', $element->desc->format)[1] == "ml"){
                    $format = explode(' ', str_replace(',', '.', $element->desc->format))[0] / 10;
                }
                $idFormat = DB::table('formats')
                ->select('id')
                ->where('taille',  $format)
                ->get();
          
                DB::table('bouteilles')->insert(
                    ['nom' => $element->nom,
                     'url_img' => $element->img,
                     'description' => $element->desc->texte,
                     'code_saq' => $element->desc->code_SAQ,
                     'pays' => $element->desc->pays,
                     'prix_saq' => explode('$', str_replace(',', '.', $element->prix))[0],
                     'format_id' => $idFormat[0]->id,
                     'type_id' => $idType[0]->id,
                     'user_id' => 1,
                     'url_saq' => $element->url
                    ]
                );
            }
        }
       print_r($array);
       // return $array;
    }

}
