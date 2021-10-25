<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bouteille extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nom', 'code_saq', 'pays', 'description', 'prix_saq', 'url_saq', 'url_img', 'format_id', 'type_id'];

    /**
     * Obtenir les informations de la table types
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * https://stackoverflow.com/questions/261783/how-to-do-select-from-where-x-is-equal-to-multiple-values
     * Obtenir les bouteilles listées et celles qui sont non-listées appantenant à l'usager connecté
     */

    public static function rechercheBouteilles($motCle) {

        return DB::table('bouteilles')
        ->where('nom', "LIKE" , "%" .$motCle. "%")
        ->whereIn("user_id", [1, 2])
        ->get();
    }
}
