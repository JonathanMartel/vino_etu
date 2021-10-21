<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellierBouteille extends Model
{
    use HasFactory;

    protected $fillable = ['garde_jusqua', 'date_achat', 'note', 'commentaire', 'prix', 'quantite', 'millesime','cellier_id', 'bouteille_id'];

    /**
     * Obtenir les informations de la table bouteilles
     */
    public function bouteille()
    {
        return $this->belongsTo(Bouteille::class);
    }

}
