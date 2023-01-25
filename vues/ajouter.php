<div class="ajouter">

    
    <div class="nouvelleBouteille" vertical layout>
        
        <div class="form-style-8" style="padding-top: 50px;">
            <h2>Ajout d'une bouteille de la SAQ au cellier</h2>


        <input type="text" name="nom_bouteille" placeholder="Recherche une bouteile" />
        </div>
        <div class="listeAutoComplete">

        </div>
<!--         <div>
            <p>Nom : <span data-id="" class="nom_bouteille"></span></p>
            <p>Millesime : <input name="millesime"></p>
            <p>Quantite : <input name="quantite" value="1"></p>
            <p>Date achat : <input name="date_achat"></p>
            <p>Prix : <input name="prix"></p>
            <p>Garde : <input name="garde_jusqua"></p>
            <p>Notes <input name="notes"></p>
        </div> -->
        
        <div class="form-style-8" style="padding-top: 0;">
            <p>Nom : <span data-id="" class="nom_bouteille"></span></p>
            Choisissez un cellier:
            <select name="id_cellier">
                <?php
                    foreach($data as $cle => $cellier)
                    echo '<option value="' . $cellier["id"]. '">Cellier: ' . $cellier['nom'] . '</option>'
                    ?>
            </select>
                <input type="text" name="millesime" placeholder="Millesime" />
                <input type="text" name="quantite" placeholder="Quantite" />
                <input type="text" name="date_achat" placeholder="Date d'achat" />
                <input type="text" name="prix_saq" placeholder="Prix"/>
                <input type="text" name="garde_jusqua" placeholder="Garde jusqu'a"/>
                <input type="text" name="notes" placeholder="Notes" />
                <input type="text" name="pays" placeholder="Pays" />

                Choisissez un type:
            <select name="id_type">
                <?php
                    foreach($datatype as $cle => $type)
                    echo '<option value="' . $type["id"]. '">' . $type['type'] . '</option>'
                    ?>
            </select>
                
                <input type="button" name="ajouterBouteilleCellier" value="Ajouter la bouteille" />
        </div>
    </div>
</div>