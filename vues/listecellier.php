<div class="cellier">

<h3><a href="?requete=ajoutercellier" class="btnlogin button-28">Ajouter un nouveau cellier</a></h3>

<h1>Vos Celliers</h1>
    
<?php
foreach ($data as $cle => $cellier) {
?>	 
    
    <div>
        <p class="nom">Nom : <?php echo $cellier['nom'] ?></p>
        <p class="quantite">Lieu : <?php echo $cellier['lieu'] ?></p>
        <p class="id">Id : <?php echo $cellier['id'] ?></p>
    <h3><a href="?requete=cellier" class="btnlogin button-18">Accéder a votre cellier</a></h3>

    </div>

<?php
}
?>	

</div>
