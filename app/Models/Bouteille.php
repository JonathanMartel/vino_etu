<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
