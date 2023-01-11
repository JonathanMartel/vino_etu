
    <?php
    foreach ($data as $cle => $bouteille) {

    ?>
        <section class="bouteille">

            <div class="imgBouteille">
                <img src="https:<?php echo $bouteille['image'] ?>">
            </div>

            <div class="descBouteille">
                <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
                <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
                <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                <p class="type">Type : <?php echo $bouteille['type'] ?></p>
                <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
                <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
            </div>

            <div class="options" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                <button>Modifier</button>
                <button>Ajouter</button>
                <button>Boire</button>
            </div>
    </section>
<?php





    }

?>