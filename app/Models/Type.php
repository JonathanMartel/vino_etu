<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'vino__type';

    /*Si on ajoute ses colonnes 
    public const CREATED_AT = null;
    public const UPDATED_AT = null;*/

    /*Pour l'instant il n'y en a pas */
    public $timestamps = false;
}
