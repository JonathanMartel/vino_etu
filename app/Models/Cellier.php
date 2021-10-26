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


    public static function getCelliersByUser($user_id)
    {
        $celliers = DB::table('celliers')
        ->where("user_id", $user_id)
        ->get();
        return $celliers;
    }

    
}
