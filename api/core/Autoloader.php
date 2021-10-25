<?php

namespace VinoAPI\Core;

/**
 * Autoload les classes.
 */
class Autoloader
{
    /**
     * Fonction statique qui démarre l'autoloader.
     *
     * @return void
     */
    public static function register()
    {
        spl_autoload_register(array(new self, 'mon_autoloader'));
    }
    
    /**
     * Custom autoloader qui va importer toutes les classes.
     *
     * @return void
     */
    private function mon_autoloader()
    {
        $dossierClasse = array('modeles/', 'libs/', 'controllers/');

        foreach ($dossierClasse as $dossier) {
            foreach (array_diff(scandir('./' . $dossier), array('.', '..')) as $file) {
                if (file_exists('./' . $dossier . $file)) {
                    require_once('./core/Router.php');
                    require_once('./modeles/Modele.php');
                    require_once('./' . $dossier . $file);
                }
            }
        }
    }
}
