###Bouteille


- ajouterBouteille()
    - Ajouter un vin
- supprimerBouteille()
    - accessible par l'admin pour les vins SAQ
    - accessible par le user créateur pour les vins personaliés
- editerBouteille()
    - accessible seulement au propriétaire ou l'admin (pour les vins de la SAQ)
    - le user qui créé un vin perso peut la modifier
- obtenirBouteille()
    - get un vin avec son id
- obtenirListeSAQ()
    - index global des vins
- recherchesBouteilles()
    - dans les vins de la SAQ et les vins du user connecté


###CellierBouteille

- ajouterQuantiteBouteille()    
  - Ajouter une seule bouteille depuis la liste //Fait
- supprimerQuantiteBouteille()  
  - Retirer une seule bouteille depuis la liste //Fait

// !!! 2 options pour ajouter ou retirer plusieurs bouteilles dansun cellier en même temps : faire 2 nouvelles méthodes ou réutiliser et modifier les 2 méthode plus haut. -> tester si fonctionne de nouveau

- ajouterBouteilleCellier()     //Ajouter un nouveau vin
- supprimerBouteilleCellier()   //Retirer un vin du cellier
- obtenirListeBouteilles()      //index des bouteilles du cellier
- rechercherCellierBouteille()

###Cellier

- ajouterCellier()
  - Ajouter un cellier et rediriger vers la liste des celliers //Fait
- supprimerCellier()
- editerCellier()
- obtenirCellier()
- obtenirListeCelliers()

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