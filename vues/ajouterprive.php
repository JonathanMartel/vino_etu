<?php
    if(!isset($succes)){
?>
<div class="ajouter">
    
    <div class="form-style-8" style="padding-top: 50px;">
        

        <h2>Ajout d'une bouteille privé dans un cellier</h2>
       
        <form data-name="form" id="ajouterPrive" action="?requete=ajouterNouvelleBouteilleCellierPrive&id=<?= $datacell[0]['id'] ?>" method="post">
            
        <div>
            <input type="hidden" name="id_cellier" value=<?= $datacell[0]['id'] ?> />
            <span id="nom" class="error-message"></span>
            <input type="text" name="nom" placeholder="Nom" />
            <span id="millesime" class="error-message"></span>            
            <input  type="number" name="millesime" placeholder="2000" />
            <span id="quantite" class="error-message"></span>
            <input type="number" name="quantite" placeholder="Quantite" min="0" value="1"/>
            <span id="prix_achat" class="error-message"></span>
            <input type="text" name="prix_achat" placeholder="Prix"/>
            <span id="pays" class="error-message"></span>
            <input type="text" name="pays" placeholder="Pays" />
        </div>
        <div>
            
            Date d'achat: <br> 
            <span id="date_achat" class="error-message"></span>
            <input type="date" name="date_achat" placeholder="Date d'achat" />            
             
            <span id="garde_jusqua" class="error-message"></span>
            <input type="text" name="garde_jusqua" placeholder="Garder jusqu'à"/>
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
            <button id="ajoutPrive" class="top button-28">Ajouter</button>
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