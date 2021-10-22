<?php
header('Content-Type: application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, PUT, POST, GET, DELETE');

/***************************************************/
/** Fichier de configuration, contient les define et l'autoloader **/
/***************************************************/
require_once('./dataconf.php');
require_once("./config.php");

/***************************************************/
/** Démarrage du controleur **/
/***************************************************/
$oCtl = new Controller();
$oCtl->gerer();
