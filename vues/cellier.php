<div class="cellier">
    <div class="grid portal no_padding">
        <?php
        foreach ($data as $cle => $bouteille) {

        ?>
            <div class="bouteille card" data-quantite="">
                <div class="img card_image">

                    <img src="https:<?php echo $bouteille['image'] ?>">
                </div>
                <div class="description">

                    <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
                    <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
                    <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                    <p class="type">Type : <?php echo $bouteille['type'] ?></p>
                    <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
                    <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
                </div>
                <div class="options bottom50" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                    <button class="card__button">Modifier</button>
                    <button class='btnAjouter'>Ajouter</button>
                    <button class='btnBoire'>Boire</button>

                </div>
            </div>
        <?php


        }

        ?>
    </div>
</div>