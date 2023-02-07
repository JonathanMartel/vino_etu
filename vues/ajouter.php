<?php
    if(!isset($succes)){
?>

<div class="ajouter">

<h2>Ajout d'une bouteille de la SAQ au cellier</h2>

    <div class="nouvelleBouteille" vertical layout>
        Recherche : <input type="text" name="nom_bouteille">
        <ul class="listeAutoComplete">

        </ul>
            <div >
                <span id="nom_bouteille" class="error-message"></span>    
                <p>Nom : <span data-id="" class="nom_bouteille"></span></p>
                <span id="millesime" class="error-message"></span>
                <p>Millesime : <input name="millesime" ></p>
                <span id="quantite" class="error-message"></span>
                <p>Quantite : <input name="quantite" value="1"></p>
                <!-- <p>Notes sur 10: <input name="notes"></p> -->
                <span id="date_achat" class="error-message"></span>
                <p>Date achat : <input type="date" name="date_achat"></p>
                <span id="garde_jusqua" class="error-message"></span>
                <p>Garde : <input type="date" name="garde_jusqua"></p>
                Choisissez un cellier:
            <select name="id_cellier">
                <?php
                    foreach($data as $cle => $cellier)
                    echo '<option value="' . $cellier["id"]. '">Cellier: ' . $cellier['nom'] . '</option>'
                    ?>
            </select>
            </div>
            <button name="ajouterBouteilleCellier">Ajouter la bouteille</button>
        </div>
    </div>
</div>
<?php
}else{
    echo '<h1>' . $succes. '</h1>';
    echo '<h2>Vous avez belle et bien ajoutez une nouvelle bouteille SAQ dans votre cellier</h2>';
    echo '<div data-id=' . $datacell[0]['id'] .'><button class="cellierid button-28">Accéder a votre cellier</button></div>';
}
?>