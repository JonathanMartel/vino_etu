<div class="cellier">

<div class="wrapajout">
    <h3><a href="?requete=ajoutercellier" class="button-28">Ajouter un nouveau cellier</a></h3>
</div>
<div class="form-style-8">

    <h2 class="titre">Vos Celliers</h2>
</div>
        <div class="flexCellier">
    <?php
    foreach ($data as $cle => $cellier) {
    ?>

<div class="card">
        <img src="/vino_etu/img/vin.jpg" alt="cellier" />
        <h3 class="nom"><?php echo $cellier['nom'] ?></h3>
        <div class="flexLieu">
            <img src="/vino_etu/img/location.png" alt="">
            <p class="lieu"><?php echo $cellier['lieu'] ?></p>
        </div>
        
    <!--     <form action="?requete=cellier" method="post">
            <input type="hidden" name="id" value="<?php echo $cellier['id'] ?>" />
            <input type="submit" value="Accéder a votre cellier" class="button-28" />
        </form> -->
        <div data-id="<?php echo $cellier['id'] ?>">
            <button class="cellierid button-28">Accéder a votre cellier</button>
        </div>
        
    </div>
    
    <?php
    }
    ?>
    </div>

</div>