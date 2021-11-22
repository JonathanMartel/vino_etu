<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'courriel',
        'password',
        'date_naissance',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param motCle
     * Rechercher dans la table users les noms qui contiennent le motCle
     * @return rows des lignes de la table users
     */
    public static function rechercheUsersParMotCle($motCle) {

        return DB::table('users')
        ->select('id','nom','courriel','date_naissance','admin')
        ->where('users.nom', "LIKE" , $motCle. "%")
        ->orWhere('users.courriel', "LIKE" , $motCle. "%")
        ->orWhere('users.date_naissance', "LIKE" , $motCle. "%")
        ->get();
    }
}
