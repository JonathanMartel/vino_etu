<?php

namespace VinoAPI\Modeles;

use VinoAPI\Libs\MonSQL;

/**
 * Classe parent des modèles.
 */
class Modele
{
	/**
	 * Instance de connexion.
	 *
	 * @var mixed
	 */
	protected $_db;

	/**
	 * __construct
	 *
	 * @return void
	 */
	function __construct()
	{
		$this->_db = MonSQL::getInstance();
	}
}
