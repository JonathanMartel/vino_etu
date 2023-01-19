<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BouteillePersonalize extends Model
{
   //use HasFactory;
   protected $guarded = [];

   protected $table = 'vino__bouteille_personalize';

   /*Si on ajoute ses colonnes 
   public const CREATED_AT = null;
   public const UPDATED_AT = null;*/

   /*Pour l'instant il n'y en a pas */
   public $timestamps = false;
}
