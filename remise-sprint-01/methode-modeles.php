<?php

/**
*
* Récupérer la liste complète du catalogue de bouteilles disponibles à ajouter au cellier de l'utilisateur.
*
*/
BouteilleController::index()


/**
 *
 * Récupérer les informations concernant une bouteille du catalogue.
 *
 * @param int|string $bouteilleId Identifiant de la bouteille du catalogue à récupérer
 */
BouteilleController::show($bouteilleId)


/**
 *
 * Ajouter une bouteille du catalogue au cellier choisi.
 *
 * @param int|string $cellierId identifiant du cellier qui contiendra la bouteille
 * @param int|string $bouteilleId identifiant de la bouteille à ajouter en inventaire dans le cellier
 * @return void
 *
 */
CellierBouteilleController::store($cellierId, $bouteilleId)


/**
 *
 * Récupérer les bouteilles qui ont été ajoutées au cellier choisi.
 *
 * @param int|string $cellierId identifiant du cellier duquel on veut afficher l'inventaire
 *
 */
CellierBouteilleController::obtenirBouteillesParCellier()
