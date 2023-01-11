<section class="containerCatalogue">
    <?php

    foreach ($data as $cle => $bouteille) {

    ?>


        <div class="carteCatalogue">
            <div>
                <img src="https:<?php echo $bouteille['image'] ?>">
                <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
                <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
                <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                <p class="type">Type : <?php echo $bouteille['type'] ?></p>
                <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p><br>
                <button>Ajouter</button>
                <button>Modifier</button>
                <button>Boire</button>
            </div>

        </div>
    <?php





    }
    ?>



</section>