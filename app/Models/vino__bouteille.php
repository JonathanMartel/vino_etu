<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vino__bouteille extends Model
{
    use HasFactory;

    protected $table = 'vino__bouteille';
    protected $fillable = ['nom', 'image', 'code_saq', 'pays', 'description', 'prix_saq', 'url_saq', 'url_image', 'format', 'type'];

}
