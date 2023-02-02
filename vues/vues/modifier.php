<div class="modifier">
    
        
        <div class="form-style-8" style="padding-top: 50px;">        
            <h2>Modification bouteille privé</h2>
            Choisissez un cellier:
            <select name="id_cellier">
                <?php
                    foreach($datacell as $cle => $cellier)
                    echo '<option value="' . $cellier["id"]. '">Cellier: ' . $cellier['nom'] . '</option>'
                    ?>
            </select>     
            Nom:    
            <input class="nom_bouteille" type="text" name="nom" value="<?= $data["nom"] ?>" />
            Millesime:
            <input type="text" name="millesime" value="<?= $data["millesime"] ?>" />
            Quantité:
            <input type="text" name="quantite" value="<?= $data["quantite"] ?>" />
            Date d'achat:
            <input type="date" name="date_achat" value="<?= $data["date_achat"] ?>" />
            Garde jusqu'a
            <input type="date" name="garde_jusqua" value="<?= $data["garde_jusqua"] ?>" />
            Prix:
            <input type="text" name="prix_achat" value="<?= $data["prix_achat"] ?>" />
            Notes sur 10:
            <input type="text" name="notes" value="<?= $data["notes"] ?>" />
            Pays:
            <input type="text" name="pays" value="<?= $data["pays"] ?>" />
            Choisissez un type:
            <select name="id_type">
                <?php
                    foreach($datatype as $cle => $type)
                    echo '<option value="' . $type["id"]. '">' . $type['type'] . '</option>'
                    ?>
            </select>
        
            <input type="hidden" name="id" value="<?= $data["id"] ?>">

            <button type="submit" class="modifierBouteille top button-28">Modifier ma bouteille</button>


        </div>
</div>
