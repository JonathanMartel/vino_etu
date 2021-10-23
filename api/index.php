<?php

use VinoAPI\Core\Autoloader;
use VinoAPI\Core\Router;

/***************************************************/
/** Headers HTTP **/
/***************************************************/

header('Content-Type: application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, PUT, POST, GET, DELETE');
header('Access-Control-Allow-Credentials: true');

/***************************************************/
/** Fichier de configuration **/
/***************************************************/
require_once('./config/dataconf.php');
require_once('./core/Autoloader.php');

/***************************************************/
/** Autoload... **/
/***************************************************/
Autoloader::register();

/***************************************************/
/** Démarrage du router **/
/***************************************************/
$oRouter = new Router;
$oRouter->gerer();
