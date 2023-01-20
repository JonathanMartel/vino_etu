<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellier extends Model
{
    //use HasFactory;

     // Empêche _aucune_ colonne d'être remplie
     protected $guarded = [];

    protected $table = 'vino__cellier';

    /*Si on ajoute ses colonnes 
    public const CREATED_AT = null;
    public const UPDATED_AT = null;*/

    /*Pour l'instant il n'y en a pas */
    public $timestamps = false;

    public $incrementing = true;

   /* relation avec Bouteille */
   public function bouteilles()
   {
       return $this->hasMany(BouteillePersonalize::class);
   }

   /* relation avec User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
