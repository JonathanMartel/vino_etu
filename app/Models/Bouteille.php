<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nom', 'image', 'code_saq', 'pays', 'description', 'prix_saq', 'url_img', 'format', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
