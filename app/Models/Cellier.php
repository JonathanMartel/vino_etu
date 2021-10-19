<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellier extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'garde_jusqua', 'date_achat', 'notes', 'prix', 'quantite', 'millesime', 'bouteille_id'];

    public function bouteille()
    {
        return $this->belongsTo(Bouteille::class);
    }
}
