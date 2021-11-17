<?php

namespace App\Models;

use DOMDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class Bouteille extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nom', 'code_saq', 'pays', 'description', 'prix_saq', 'url_saq', 'url_img', 'format_id', 'type_id', 'user_id'];

    /**
     * Obtenir les informations de la table types
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function format()
    {
        return $this->belongsTo(Format::class);
    }

    /**
     * @param motCle
     * Rechercher dans la table bouteilles les noms qui contiennent le motCle
     * @return rows des lignes de la table bouteilles
     */
    public static function rechercheBouteillesParMotCle($motCle) {

        return DB::table('bouteilles')
        ->select('bouteilles.nom', 'bouteilles.id', 'pays', 'description', 'type', 'type_id', 'format_id', 'url_img', 'prix_saq', 'taille' )
        ->where('bouteilles.nom', "LIKE" , "%" .$motCle. "%")
        ->whereIn("user_id", [1, session('user')->id])
        ->join('types', 'bouteilles.type_id', '=', 'types.id')
        ->join('formats', 'formats.id', '=', 'bouteilles.format_id')
        ->get();
    }

        /**
     * @param $request
     * Rechercher dans la table bouteilles pour vérifier si une bouteille existe déjà
     * @return row une ligne de la table bouteilles
     */
    public static function rechercheBouteilleExistante($request) {
        return DB::table('bouteilles')
        ->where('nom', $request->nom)
        ->where('pays', $request->pays)
        ->where('type_id', $request->type_id)
        ->where('format_id', $request->format_id)
        ->whereIn("user_id",  [1, session('user')->id])
        ->get();
    }

       /**
     * @param $request
     * obtenir les informations d'une bouteille avec son ID
     * @return row une ligne de la table bouteilles
     */
    public static function getDataBouteilleByID($IDBouteille) {
        return DB::table('bouteilles')
        ->select('bouteilles.id', 'bouteilles.nom as nom','pays', 'formats.nom as format', 'type', 'formats.taille as taille', 'url_img', 'description', 'prix_saq', 'code_saq', 'url_saq')
        ->join('types', 'types.id', '=', 'bouteilles.type_id')
        ->join('formats', 'formats.id', '=', 'bouteilles.format_id')
        ->where('bouteilles.id', $IDBouteille)
        ->get();
    }

    /**
     * Ajouter les nouvelles bouteilles qui n'étaient pas dans la BD
     * @param collection un tableau de bouteilles venant du site de la SAQ après être nettoyé
     * @return nouvellesBouteilles les bouteilles qui on été ajoutées dans la BD
     */
    public static function ajouterNouvellesBouteilles($collection)
    {  
        $nouvellesBouteilles = [];
        
        foreach($collection as $element) {
     
            $bouteille = DB::table('bouteilles')
            ->where('code_saq', $element->desc->code_SAQ)
            ->get();


            if($bouteille->isEmpty()){
                if($element->desc->type == "Cocktail au vin"){
                    $type = "Cocktail au vin";
                }else if ($element->desc->type == "Vin de tomate"){
                        $type = "Vin de tomate";
                
                }else if ($element->desc->type == "Vin de dessert") {
                    $type = "Vin de dessert";
                }
                else {
                    $type = ucfirst(explode(' ', $element->desc->type)[1]);
                }
                $idType = DB::table('types')
                ->select('id')
                ->where('type', $type)
                ->get();

                if( explode(' ', $element->desc->format)[1] == "L") {
                    $format = explode(' ', str_replace(',', '.', $element->desc->format))[0] * 100;

                }else if (explode(' ', $element->desc->format)[1] == "ml"){
                    $format = explode(' ', str_replace(',', '.', $element->desc->format))[0] / 10;
                }
                $idFormat = DB::table('formats')
                ->select('id')
                ->where('taille',  $format)
                ->get();
          
                $id = DB::table('bouteilles')->insertGetId(
                    ['nom' => $element->nom,
                     'url_img' => $element->img,
                     'description' => $element->desc->texte,
                     'code_saq' => $element->desc->code_SAQ,
                     'pays' => $element->desc->pays,
                     'prix_saq' => (double)explode('$', str_replace(',', '.', $element->prix))[0],
                     'format_id' => $idFormat[0]->id,
                     'type_id' => $idType[0]->id,
                     'user_id' => 1,
                     'url_saq' => $element->url
                    ]
                );
        
                array_push($nouvellesBouteilles, ["nom" => $element->nom,
                                              'url_img' =>$element->img ,
                                              'description' =>$element->desc->texte,
                                              'code_saq' => $element->desc->code_SAQ,
                                              'pays' => $element->desc->pays,
                                              'prix_saq' => number_format((float)explode('$', str_replace(',', '.', $element->prix))[0], 2, '.', '') . " $",
                                              'format' => $format . " cL",
                                              'type' => ucfirst(explode(' ', $element->desc->type)[1]),
                                              'url_saq' => $element->url,
                                              'idBouteille' => $id]);
                                    
            }  
        }
        
        return $nouvellesBouteilles;
    }

    /**
	 * Faire un curl pour obtenir des bouteilles du site de la SAQ
	 * @param int $nombre
	 * @param int $debut
     * @return ajouterNouvellesBouteilles un tableau contant les bouteilles ajoutées
	 */
	public static function obtenirListeSAQ($page) {
		$s = curl_init();
		$url = "https://www.saq.com/fr/produits/vin?p=${page}&product_list_limit=96&product_list_order=name_asc";
      
        curl_setopt_array($s,array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
            CURLOPT_ENCODING=>'gzip, deflate',
            CURLOPT_HTTPHEADER=>array(
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language: en-US,en;q=0.5',
                    'Accept-Encoding: gzip, deflate',
                    'Connection: keep-alive',
                    'Upgrade-Insecure-Requests: 1',
            ),
        ));

		$_webpage = curl_exec($s);
          
       
		curl_close($s);
      
		$doc = new DOMDocument();
		$doc -> recover = true;
		$doc -> strictErrorChecking = false;
		@$doc -> loadHTML($_webpage);
		$elements = $doc -> getElementsByTagName("li");
	
        $collection = new Collection();
		foreach ($elements as $noeud) {		
			if (strpos($noeud -> getAttribute('class'), "product-item") !== false) {
               
				$info = self::recupereInfo($noeud);
                if($page == 1 && $collection->count() == 0){
                    
                    session([ 'premiereBouteille' => $info]);
                   
                }else  if(session('premiereBouteille') == $info){
                    return 'stop';
                }
               $collection->push($info);
            }
		}
      
		return self::ajouterNouvellesBouteilles($collection);
	}

	private static function nettoyerEspace($chaine)
	{
		return preg_replace('/\s+/', ' ',$chaine);
	}

    private static function recupereInfo($noeud) {
		
		$info = new stdClass();
		$info -> img = $noeud -> getElementsByTagName("img") -> item(0) -> getAttribute('src'); //TODO : Nettoyer le lien
		;
		$a_titre = $noeud -> getElementsByTagName("a") -> item(0);
		$info -> url = $a_titre->getAttribute('href');
		
        $nom = $noeud -> getElementsByTagName("a")->item(1)->textContent;
       
		$info -> nom = self::nettoyerEspace(trim($nom));
	
		$aElements = $noeud -> getElementsByTagName("strong");
		
        foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'product product-item-identity-format') {
				$info -> desc = new stdClass();
				$info -> desc -> texte = $node -> textContent;
				$info->desc->texte = self::nettoyerEspace($info->desc->texte);
				$aDesc = explode("|", $info->desc->texte); // Type, Format, Pays
				if (count ($aDesc) == 3) {
					
					$info -> desc -> type = trim($aDesc[0]);
					$info -> desc -> format = trim($aDesc[1]);
					$info -> desc -> pays = trim($aDesc[2]);
				}
				
				$info -> desc -> texte = trim($info -> desc -> texte);
			}
		}

		//Code SAQ
		$aElements = $noeud -> getElementsByTagName("div");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'saq-code') {
				if(preg_match("/\d+/", $node -> textContent, $aRes))
				{
					$info -> desc -> code_SAQ = trim($aRes[0]);
				}	
				
			}
		}

		$aElements = $noeud -> getElementsByTagName("span");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'price') {
				$info -> prix = trim($node -> textContent);
			}
		}

		return $info;
	}

    

}
