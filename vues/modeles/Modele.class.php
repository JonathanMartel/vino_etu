<?php
/**
 * Class Modele
 * Template de classe modèle. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Modele {
	
    protected $_db;
	function __construct ()
	{
		$this->_db = MonSQL::getInstance();
	}
	
	function __destruct ()
	{
		
	}

	protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8';
            $db = new PDO($dsn, USER, PASSWORD);

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}




?>