# Relations

1 Usager peut avoir 1 à plusieurs Cellier.
1 Cellier appartient qu'à 1 Usager 
1:N

1 Cellier peut contenir plusieurs Bouteille
1 Bouteille peut être dans plusieurs Cellier
N:M

# Liste des opérations des modèles

## Usager

Usager::get
Usager::add


##### À venir opération par l'admin
   - Usager::delete
   - Usager::update (est-ce nécessaire?)

## Cellier

Cellier::getListe
Cellier::getOne

Cellier::add
Cellier:update
Cellier:delete

## Bouteille
Bouteille::getListe
Bouteille::getOne

Bouteille::add
Bouteille:update
Bouteille:delete

## SAQ
SAQ::update  // importation du catalogue par l'admin