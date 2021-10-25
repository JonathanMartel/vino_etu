<?php

namespace Database\Seeders;

use App\Models\Bouteille;
use App\Models\Categorie;
use App\Models\Pays;
use Illuminate\Database\Seeder;

class BouteilleSeeder extends Seeder {
    /**
     * getProduits
     * @param int $nombre
     * @param int $debut
     */
    static public function getProduitsParCategorie($nombre = 24, $page = 1, $categorie_url = "vin/vin-rouge") {
        // Carotgraphier l'id de la catégorie selon l'url reçu
        /* $categoriesUrlIdMapping = [
            "vin/vin-blanc" => "1",
            "vin/vin-rouge" => "2",
        ]; */


        $s = curl_init();
        $url = "https://www.saq.com/fr/produits/vin/vin-rouge?p=1&product_list_limit=24&product_list_order=name_asc";

        // Se prendre pour un navigateur pour berner le serveur de la saq...
        curl_setopt_array($s, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
            CURLOPT_ENCODING => 'gzip, deflate',
            CURLOPT_HTTPHEADER => array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Accept-Encoding: gzip, deflate',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
            ),
        ));

        $webpage = curl_exec($s);

        curl_close($s);

        $doc = new \DOMDocument();
        $doc->recover = true;
        $doc->strictErrorChecking = false;

        @$doc->loadHTML($webpage);

        $elements = $doc->getElementsByTagName("li");
        // dd(iterator_to_array($elements));
        $i = 0;

        foreach ($elements as $noeud) {
            if (strpos($noeud -> getAttribute('class'), "product-item") === false) {
                continue;
			}

            $info = self::recupereInfo($noeud);

            var_dump($info);

            Bouteille::create(self::recupereInfo($noeud));
        }

        return $i;
    }

    static private function nettoyerEspace($chaine) {
        return preg_replace('/\s+/', ' ', $chaine);
    }

    static private function recupereInfo($noeud) {

        $info = new \stdClass();

        $info->url_image = explode("?", $noeud->getElementsByTagName("img")->item(0)->getAttribute('src'))[0];

        $info->url_achat = $noeud->getElementsByTagName("a")->item(0)->getAttribute('href');

        $nom = $noeud->getElementsByTagName("a")->item(1)->textContent;
        $info->nom = self::nettoyerEspace(trim($nom));

        // Type, format et pays
        $aElements = $noeud->getElementsByTagName("strong");
        foreach ($aElements as $node) {
            if ($node->getAttribute('class') == 'product product-item-identity-format') {
                $info->description = self::nettoyerEspace($node->textContent);

                $aDesc = explode("|", $info->description); // Type, Format, Pays

                if (count($aDesc) == 3) {
                    $info->categories_id = Categorie::select("id")->where("nom", trim($aDesc[0]))->get()->first()->id;
                    $info->format = trim($aDesc[1]);
                    $info->pays_id = Pays::select("id")->where("nom", trim($aDesc[2]))->get()->first()->id;
                }

                $info->description = trim($info->description);
            }
        }

        //var_dump($info);
        return (array) $info;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->getProduitsParCategorie();
    }
}
