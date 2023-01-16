<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille extends Model
{
    //use HasFactory;

    protected $table = 'vino__bouteille';

    /*Si on ajoute ses colonnes 
    public const CREATED_AT = null;
    public const UPDATED_AT = null;*/

    /*Pour l'instant il n'y en a pas */
    public $timestamps = false;
}
