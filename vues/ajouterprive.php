<?php
    if(!isset($succes)){
?>
<div class="ajouter">
    
    <div class="form-style-8" style="padding-top: 50px;">
        
        <h2>Ajout d'une bouteille privé dans un cellier</h2>
        <!--  <div class="form-style-8" style="padding-top: 0;">-->
        <form data-name="form" action="?requete=ajouterNouvelleBouteilleCellierPrive&id=<?= $datacell[0]['id'] ?>" method="post">
            
        <div>
            <input type="hidden" name="id_cellier" value=<?= $datacell[0]['id'] ?> />
            <span id="nom" class="error-message"></span>
            <input type="text" name="nom" placeholder="Nom" />            
            <input  type="number" name="millesime" placeholder="2000" />
            <span id="quantite" class="error-message"></span>
            <input type="number" name="quantite" placeholder="Quantite" min="0" value="0"/>
            
            <input type="text" name="prix_achat" placeholder="Prix"/>
            <input type="text" name="pays" placeholder="Pays" />
        </div>
        <div>
            Date d'achat:
            <input type="date" name="date_achat" placeholder="Date d'achat" />
            Garder jusqu'a:
            <input type="date" name="garde_jusqu'à" placeholder="Garde jusqu'à"/>
            Choisissez un type:
            <select name="id_type">
                <?php
                    foreach($datatype as $cle => $type)
                    echo '<option value="' . $type["id"]. '">' . $type['type'] . '</option>'
                    ?>
            </select>
            <div class="error-message"></div>
        </div>
        <div>            
            <button data-js-submit id="ajout" class="top button-28">Ajouter</button>
        </div>
        </form>
        
    </div>
</div>
<?php
}else{
    echo '<h1>' . $succes. '</h1>';
    echo '<h2>Vous avez belle et bien ajoutez une nouvelle bouteille privé dans votre cellier</h2>';
    echo '<div data-id=' . $datacell[0]['id'] .'><button class="cellierid button-28">Accéder a votre cellier</button></div>';
}
?>