<div class="cellier">

<h1>Nom du Cellier: <?= $datacell[0]['nom']?></h1>
<!-- <p><a href="?requete=ajouterNouvelleBouteilleCellierPrive">Ajouter une bouteille au cellier privé</a></p> -->
<!-- <p><a href="?requete=ajouterNouvelleBouteilleCellier" class="btnlogin button-28">Ajouter une bouteille au cellier de la SAQ</a></p> -->
    

<?php
foreach ($dataprive as $cle => $bouteille) {
    ?>
    <div class="bouteille cardcellier">
        <h2>Bouteille Privé</h2>
        <div class="img"> 
          <img src="/vino_etu/img/bte.png">
        </div>
        <div class="description">
            <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
            <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
            <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
            <p class="type">Type : <?php echo $bouteille['id_type'] ?></p>
            <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
        </div>
        <div class="options" data-id="<?php echo $bouteille['id'] ?>">
            <!-- <button>Modifier</button> -->
            <button class="btnModifier">Modifier</button>
            <button class='btnAjouter'>Ajouter</button>
            <button class='btnBoire'>Boire</button>  

            <form action="?requete=deleteprive" method="post">
                <input type="hidden" name="id" value="<?php echo $bouteille['id'] ?>" />
                <input type="submit" value="Supprimer" />
            </form>
        </div>
    </div>
<?php
}
?>


<?php
foreach ($data as $cle => $bouteille) {
    ?>
    <div class="bouteille cardcellier">
        <h2>Bouteille SAQ</h2>
        <div class="img">
            
            <img src="<?php echo $bouteille['image'] ?>">
        </div>
        <div class="description">
            <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
            <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
            <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
            <p class="type">Type : <?php echo $bouteille['id_type'] ?></p>
            <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
            <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
        </div>
        <div class="options" data-id="<?php echo $bouteille['id'] ?>">
            <button>Modifier</button>
            <button class='btnAjoutersaq'>Ajouter</button>
            <button class='btnBoiresaq'>Boire</button>
            <form action="?requete=deleteSAQ" method="post">
                <input type="hidden" name="id" value="<?php echo $bouteille['id'] ?>" />
                <input type="submit" value="Supprimer" />
            </form>
        </div>
    </div>
<?php
}
?>	

</div>