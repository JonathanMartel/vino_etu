<?php
session_start();

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
	 * Traite la requête
	 * @return void
	 */
	public function gerer()
	{
		if(isset($_GET['id'])) $id = $_GET['id'];

		switch ($_GET['requete']) {
			/* case 'listeBouteille':
				$this->listeBouteille();
				break; */
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

			case 'ajouterBouteilleCellierSAQ':
				$this->ajouterBouteilleCellierSAQ();
				break;
			case 'boireBouteilleCellierSAQ':
				$this->boireBouteilleCellierSAQ();
				break;
			case 'profil':
				$this->profil();
				break;
			case 'profilmod':
				$this->profilmod();
				break;
			case 'register':
				$this->register();
				break;
			case 'login':
				$this->login();
				break;
			case 'deconnexion':
				$this->deconnexion();
				break;
			case 'cellier':
				$this->cellier();
				break;
			case 'listecellier':
				$this->listecellier();
				break;
			case 'ajoutercellier':
				$this->ajoutercellier();
				break;
			case 'ajouterNouvelleBouteilleCellierPrive':
				$this->ajouterNouvelleBouteilleCellierPrive();
				break;
			case 'deleteprive':
				$this->deleteprive();
				break;
			case 'deleteSAQ':
				$this->deleteSAQ();
				break;

				//yordan
			case "getBouteille":
				$this->getBouteille($id);
				break;
			case "modifierBouteilleCellier":
				$this->modifierBouteilleCellier();
				break;	


			default:
				$this->accueil();
				break;
		}
	}


	private function accueil()
	{
		include("vues/entete.php");
		include("vues/accueil.php");
		include("vues/pied.php");
	}

	private function profil()
	{
		include("vues/entete.php");
		include("vues/profil.php");
		include("vues/pied.php");
	}
	private function profilmod()
	{
		if (!empty($_POST)) {
			$user = new Usager();
			$user->updateProfil($_POST);
			$_SESSION['usager'][0]['nom'] = $_POST['nom'];
			$_SESSION['usager'][0]['email'] = $_POST['email'];
			header("Location: http://localhost:8080/vino_etu/?requete=profil");
			exit();
		}
		include("vues/entete.php");
		include("vues/profilmod.php");
		include("vues/pied.php");
	}

	private function register()
	{
		if (!empty($_POST)) {
			$user = new Usager();
			$user->addUtilisateur($_POST);
			header("Location: http://localhost:8080/vino_etu/?requete=login");
			exit();
		}
		include("vues/entete.php");
		include("vues/register.php");
		include("vues/pied.php");
	}

	private function login()
	{
		if (!empty($_POST)) {
			$erreur = false;
			$email = $_POST['email'];
			$mdp = $_POST['mdp'];
			$user = new Usager();
			$usager = $user->unUsager($email);

			if (!$usager || !password_verify($mdp, $usager[0]['mdp'])) {

				$erreur = "Combinaison courriel/mot de passe erronée";
				var_dump($erreur);
			}

			if (!$erreur) {
				$_SESSION['usager'] = $usager;
				header("Location: http://localhost:8080/vino_etu/");
				exit();
			}
		}
		include("vues/entete.php");
		include("vues/login.php");
		include("vues/pied.php");
	}

	public function deconnexion()
	{
		unset($_SESSION['usager']);
		include("vues/entete.php");
		include("vues/accueil.php");
		include("vues/pied.php");
	}

	private function cellier()
	{
		if (!empty($_POST)) {

			$id_cellier = $_POST['id']; // TROUVER COMMENT PASSER L'ID CELLIER
			$cellier = new Cellier();
			$datacell = $cellier->getCellier($id_cellier);
			$bte = new Bouteille();
			$data = $bte->getListeBouteilleSAQ($id_cellier);
			$dataprive = $bte->getListeBouteillePrive($id_cellier);
		}
			//var_dump($data);
		include("vues/entete.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}
	private function deleteprive()
	{
		if (!empty($_POST)) {

			$id_bouteille = $_POST['id']; 
			$bte = new Bouteille();
			$bte->deleteprive($id_bouteille);
			header("Location: http://localhost:8080/vino_etu/?requete=listecellier");
		}
	}
	private function deleteSAQ()
	{
		if (!empty($_POST)) {

			$id_bouteille = $_POST['id']; 
			$bte = new Bouteille();
			$bte->deleteSAQ($id_bouteille);
			header("Location: http://localhost:8080/vino_etu/?requete=listecellier");
		}
	}

	private function listecellier()
	{
		$id_usager = $_SESSION['usager'][0]['id'];
		$cellier = new Cellier();
		$data = $cellier->getListeCelliers($id_usager);
		//echo json_encode($data);           
		include("vues/entete.php");
		include("vues/listecellier.php");
		include("vues/pied.php");
	}

	private function ajoutercellier()
	{
		if (!empty($_POST)) {
			$celier = new Cellier();
			$celier->ajouterCellier($_POST);
			// Afficher liste des celliers
			header("Location: http://localhost:8080/vino_etu/?requete=listecellier");
		} else {
			include("vues/entete.php");
			include("vues/ajoutcellier.php");
			include("vues/pied.php");
		}
	}
	private function ajouterNouvelleBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		//var_dump($body);
		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->ajouterBouteilleCellier($body);
			echo json_encode($resultat);
		} else {
			$cellier = new Cellier();
			$id_usager = $_SESSION['usager'][0]['id'];
			$data = $cellier->getListeCelliers($id_usager);
			$bte = new Bouteille();
			$datatype =  $bte->getListeType();
			//var_dump($datatype);
			include("vues/entete.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}
	private function ajouterNouvelleBouteilleCellierPrive()
	{
		if (!empty($_POST)) {
			$bte = new Bouteille();
			$bte->ajouterBouteilleCellierPrive($_POST);
			header("Location: http://localhost:8080/vino_etu/?requete=listecellier");
	} else {
		$id_usager = $_SESSION['usager'][0]['id'];
		$cellier = new Cellier();
		$data = $cellier->getListeCelliers($id_usager);
		$bte = new Bouteille();
		$datatype =  $bte->getListeType();
			include("vues/entete.php");
			include("vues/ajouterprive.php");
			include("vues/pied.php");
		}
	}

/* 	private function listeBouteille()
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier();
		echo json_encode($cellier);
	} */

	private function autocompleteBouteille()
	{
		$bte = new Bouteille();
		//var_dump(file_get_contents('php://input'));
		$body = json_decode(file_get_contents('php://input'));
		//var_dump($body);
		$listeBouteille = $bte->autocomplete($body->nom);
		echo json_encode($listeBouteille);
		
	}

	private function boireBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
		echo json_encode($resultat);
	}
	private function ajouterBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
		echo json_encode($resultat);
	}
	private function boireBouteilleCellierSAQ()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellierSAQ($body->id, -1);
		echo json_encode($resultat);
	}
	private function ajouterBouteilleCellierSAQ()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellierSAQ($body->id, 1);
		echo json_encode($resultat);
	}

///yordan
	private function getBouteille($id)
	{
		$bte = new Bouteille();
		$data = $bte->getBouteilleCellier($id);
		$id_usager = $_SESSION['usager'][0]['id'];
		$cellier = new Cellier();
		$datacell = $cellier->getListeCelliers($id_usager);
		$bte = new Bouteille();
		$datatype =  $bte->getListeType();
		include("vues/entete.php");
		include("vues/modifier.php");
		include("vues/pied.php");
	}
	private function modifierBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		if(!empty($body)){
			$bte = new Bouteille();
			$resultat = $bte->modifierBouteilleCellier($body);			
			echo json_encode($resultat);
			header("Location: http://localhost:8080/vino_etu/?requete=listecellier");
			exit();
		}
		else {
			include("vues/entete.php");
			include("vues/modifier.php");
			include("vues/pied.php");
		}
		
	}
}
