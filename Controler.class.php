<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler 
{
	
		/**
		 * Fonction qui traite la requête 
		 * @return void
		 */
		public function gerer()
		{
			
			switch ($_GET['requete']) {
				case 'listeBouteille':
					$this->listeBouteille();
					break;
				case 'uneBouteilleCellier':
					$this->getBouteille();
					break;
				case 'autocompleteBouteille':
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
					$this->ajouterNouvelleBouteilleCellier();
					break;
				case 'ajouterBouteilleCellier':
					$this->ajouterBouteilleCellier();
					break;
				case 'boireBouteilleCellier':
					$this->boireBouteilleCellier();
					break;
				case 'modifierBouteilleCellier':
					$this->modifierBouteilleCellier();
					break;
				default:
					$this->accueil();
					break;
			}
		}

		/**
		 * Traite la page d'accueil
		 * @return void
		 */
		private function accueil()
		{
			$bte = new Bouteille();
            $data = $bte->getListeBouteilleCellier();
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
                  
		}
		
		/**
		 * Retourne la liste des bouteilles d'un cellier
		 * @return string Retourne un JSON encodé en tant que chaîne de caractères 
		 */
		private function listeBouteille()
		{
			$bte = new Bouteille();
            $cellier = $bte->getListeBouteilleCellier();  
            echo json_encode($cellier);
                  
		}
		
		
		/**
		 * Retourne la bouteilles d'un cellier
		 * @return string Retourne un JSON encodé en tant que chaîne de caractères 
		*/
		private function getBouteille()
		{
			$body = json_decode(file_get_contents('php://input'));  //out idCellier et idVin

			var_dump()


			$bte = new Bouteille();
            $cellier = $bte->getBouteilleCellier();  
            echo json_encode($cellier);
                  
		}

		/**
		 * Retourne la liste des bouteilles de la bd à partir d'une boîte de dialogue d'autocomplete
		 * @return string Retourne un JSON encodé en tant que chaîne de caractères 
		 */
		private function autocompleteBouteille()
		{
			$bte = new Bouteille();
			$body = json_decode(file_get_contents('php://input'));
            $listeBouteille = $bte->autocomplete($body->nom);
            echo json_encode($listeBouteille);        
		}

		/**
		 * 
		 * Ajout d'une bouteille dans un cellier si tous les champs requis sont rempli sinon traite la vue ajouter
		 * @return Bool True si l'ajout est réussi
		 */
		private function ajouterNouvelleBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
			if(!empty($body)){
				$bte = new Bouteille();
				//var_dump($_POST['data']);
				
				//var_dump($data);
				$resultat = $bte->ajouterBouteilleCellier($body);
				echo json_encode($resultat);
			}
			else{
				include("vues/entete.php");
				include("vues/ajouter.php");
				include("vues/pied.php");
			}
			
            
		}


		/**
		 * 
		 * Modification d'une bouteille dans un cellier si tous les champs requis sont rempli sinon traite la vue modification
		 * @return Bool True si la modification est réussie
		 */
		private function modifierBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));  //out idCellier
			
			//$nom = $bte->getBouteilleNom($id);
			if(!empty($body)){
				$bte = new Bouteille();
				//var_dump($_POST['data']);
				
				//var_dump($data);
				$resultat = $bte->modifieBouteilleCellier($id);
				echo json_encode($resultat);
			}
			else{
				include("vues/entete.php");
				include("vues/modifier.php");
				include("vues/pied.php");
			}
			
            
		}


		/**
		 * Enlève la bouteille au cellier
		 */
		private function boireBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
			echo json_encode($resultat);
		}

		/**
		 * Ajout la bouteille au cellier
		 */
		private function ajouterBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
			echo json_encode($resultat);
		}
		
}
?>















