<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SQL extends Model
{
    use HasFactory;

    	/**
	 * @var $_instance
	 * @access private
	 * @static
	 */
	private static $_instance = null;

	/**
	 * Constructeur de la classe
	 *
	 * @param void
	 * @return void
	 */
	private function __construct($host, $user, $password, $database) 
	{
		
	}

	/**
	 * Méthode qui crée l'unique instance de la classe
	 * si elle n'existe pas encore puis la retourne.
	 *
	 * @param void
	 * @return Singleton
	 */
	public static function getInstance() {

        // Test database connection
		if (is_null(self::$_instance)) {
			try {
                self::$_instance = DB::connection()->getPDO();
               // dd(self::$_instance);
            } catch (\Exception $e) {
                die("Echec lors de la connexion à MySQL : (" .$e . ") " .$e);
            }
		}
       //dd(self::$_instance) ;
		return self::$_instance;
	}

}
