###Bouteille


- ajouterBouteille()
    - Ajouter un vin
- supprimerBouteille()
    - accessible par l'admin pour les vins SAQ
    - accessible par le user créateur pour les vins personaliés
- editerBouteille()
    - accessible seulement au propriétaire ou l'admin (pour les vins de la SAQ)
    - le user qui créé un vin perso peut la modifier
- getDataBouteilleByID
    - get un vin avec son id
- ajouterNouvellesBouteille()
    - Ajouter les nouvelles bouteilles qui n'étaient pas dans la BD
- rechercheBouteillesParMotCle()
    - dans les vins de la SAQ et les vins du user connecté
- rechercheBouteilleExistante()
    - vérifier si une bouteille existe déjà avant de la créer

###CellierBouteille

- ajouterQuantiteBouteille()    
  - Ajouter une seule bouteille depuis la liste //Fait
- supprimerQuantiteBouteille()  
  - Retirer une seule bouteille depuis la liste //Fait
- ajouterBouteilleCellier()     //Ajouter une bouteille dans le cellier
- supprimerBouteilleCellier()   //Retirer un vin du cellier
- obtenirListeBouteilleCellier()      //index des bouteilles du cellier
- rechercherCellierBouteille()   // Vérifier si une bouteille existe déjà dans le cellier
- obtenirMillesimesParBouteille()
  - obtenir les différents millesime d'une bouteille dans un cellier
- ajouterNote()
  - ajouter une note de dégustation à une bouteille
- modifierCellierBouteille() // modifier quantité, commentaire, date_achat et garde_jusqua
- modifierQuantiteBouteille() // modifier la quantité d'une bouteille

###Cellier

- ajouterCellier()
  - Ajouter un cellier et rediriger vers la liste des celliers //Fait
- supprimerCellier()
- editerCellier()
- obtenirCellier()
- getCelliersByUser()
- rechercheDansCellier()

###Format

- obtenirListeFormat()
- obtenirFormat()

###Type

- obtenirListeType()
- obtenirType()

###User

- ajouterUser()
- supprimerUser()
- editerUser()
- authentification()
- deconnexion()