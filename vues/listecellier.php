<div class="cellier">

<div class="wrapajout">
    <h3><a href="?requete=ajoutercellier" class="btnlogin button-28">Ajouter un nouveau cellier</a></h3>
    <h3><a href="?requete=ajouterNouvelleBouteilleCellierPrive" class="btnlogin button-28">Ajouter une bouteille privé</a></h3>
    <h3><a href="?requete=ajouterNouvelleBouteilleCellier" class="btnlogin button-28">Ajouter une bouteille SAQ</a></h3>
</div>
    <h1>Vos Celliers</h1>

    <?php
    foreach ($data as $cle => $cellier) {
    ?>

        <div class="card">
            <img src="/vino_etu/img/vin.jpg" alt="" style="width: 300px; border-radius: 15px;">
            <h3 class="nom">Nom : <?php echo $cellier['nom'] ?></h3>
            <p class="quantite">Lieu : <?php echo $cellier['lieu'] ?></p>
            <p class="id">Id : <?php echo $cellier['id'] ?></p>
            <!--     <h3><a href="?requete=cellier" class="btnlogin button-18">Accéder a votre cellier</a></h3> -->

            <form action="?requete=cellier" method="post">
                <input type="hidden" name="id" value="<?php echo $cellier['id'] ?>" />
                <input type="submit" value="Accéder a votre cellier" class="btnlogin button-28" />
            </form>

        </div>

    <?php
    }
    ?>

</div>