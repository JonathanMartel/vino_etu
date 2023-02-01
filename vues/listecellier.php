<div class="cellier">

<div class="wrapajout">
    <h3><a href="?requete=ajoutercellier" class="btnlogin button-28">Ajouter un nouveau cellier</a></h3>
</div>
    <h1>Vos Celliers</h1>
        <div class="flexCellier">
    <?php
    foreach ($data as $cle => $cellier) {
    ?>

<div class="card">
        <img src="/vino_etu/img/vin.jpg" alt="" style="width: 300px; border-radius: 15px;">
        <h3 class="nom"><?php echo $cellier['nom'] ?></h3>
        <div class="flexLieu">
            <img src="/vino_etu/img/location.png" alt="">
            <p class="lieu"><?php echo $cellier['lieu'] ?></p>
        </div>
        
    <!--     <form action="?requete=cellier" method="post">
            <input type="hidden" name="id" value="<?php echo $cellier['id'] ?>" />
            <input type="submit" value="Accéder a votre cellier" class="btnlogin button-28" />
        </form> -->
        <div data-id="<?php echo $cellier['id'] ?>">
            <button class="cellierid">Accéder a votre cellier</button>
        </div>
        
    </div>
    
    <?php
    }
    ?>
    </div>

</div>