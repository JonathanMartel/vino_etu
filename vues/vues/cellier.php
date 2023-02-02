
<?php
    if(!isset($succes)){
?>

<div class="cellier">

<h1>Nom du Cellier: <?= $datacell[0]['nom']?></h1>
<!-- <p><a href="?requete=ajouterNouvelleBouteilleCellierPrive">Ajouter une bouteille au cellier privé</a></p> -->
<!-- <p><a href="?requete=ajouterNouvelleBouteilleCellier" class="button-28">Ajouter une bouteille au cellier de la SAQ</a></p> -->
<h3><a href="?requete=ajouterNouvelleBouteilleCellierPrive&id=<?= $datacell[0]['id']?>" class="button-28">Ajouter une bouteille privé</a></h3>
      <h3><a href="?requete=ajouterNouvelleBouteilleCellier&id=<?= $datacell[0]['id']?>" class="button-28">Ajouter une bouteille SAQ</a></h3>
    

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
            <p class="prix_achat">Prix : <?php echo $bouteille['prix_achat'] ?> $</p>
            <?php if(isset($bouteille['notes'])){ echo '<p class="notes">Notes : ' . $bouteille['notes'] . '</p>';}?>
            <p class="type">Type : <?php 
            if($bouteille['id_type'] == 1){
                echo 'Vin Rouge';
            }elseif($bouteille['id_type'] == 2){
                echo 'Vin Blanc';
            }elseif($bouteille['id_type'] == 3){
                echo 'Vin Rosé';
            }elseif($bouteille['id_type'] == 4){
                echo 'Vin Mousseux';
            }?></p>
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
            <p class="prix_saq">Prix SAQ : <?php echo $bouteille['prix_saq'] ?> $</p>
            <p class="format">Format : <?php echo $bouteille['format'] ?></p>
            <?php if(isset($bouteille['notes'])){ echo '<p class="notes">Notes : ' . $bouteille['notes'] . '</p>';}?>
            <p class="type">Type : <?php 
            if($bouteille['type'] == 1){
                echo 'Vin Rouge';
            }elseif($bouteille['type'] == 2){
                echo 'Vin Blanc';
            }elseif($bouteille['type'] == 3){
                echo 'Vin Rosé';
            }elseif($bouteille['type'] == 4){
                echo 'Vin Mousseux';
            }?></p>
            <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
            <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
        </div>
        <div class="options" data-id="<?php echo $bouteille['vbsid'] ?>">
            <button class="btnModifiersaq">Modifier</button>
            <button class='btnAjoutersaq'>Ajouter</button>
            <button class='btnBoiresaq'>Boire</button>
            <form action="?requete=deleteSAQ" method="post">
                <input type="hidden" name="id" value="<?php echo $bouteille['id_bouteille'] ?>" />
                <input type="submit" value="Supprimer" />
            </form>
        </div>
    </div>
<?php
}
?>	

</div>
<?php
}else{
    echo '<h1>' . $succes. '</h1>';
    echo '<h2>Vous avez belle et bien supprimer la bouteille privé</h2>';
    echo '<a href="?requete=listecellier">Liste Celliers</a>';
}
?>