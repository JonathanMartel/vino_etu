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
            <input class="nom_bouteille" type="text" name="nom" value="<?= $data["nom"] ?>" />
            <input type="text" name="millesime" value="<?= $data["millesime"] ?>" />
            <input type="text" name="quantite" value="<?= $data["quantite"] ?>" />
            <input type="text" name="date_achat" value="<?= $data["date_achat"] ?>" />
            <input type="text" name="prix_achat" value="<?= $data["prix_achat"] ?>" />
            <input type="text" name="garde_jusqua" value="<?= $data["garde_jusqua"] ?>" />
            <input type="text" name="notes" value="<?= $data["notes"] ?>" />
            <input type="text" name="pays" value="<?= $data["pays"] ?>" />
            Choisissez un type:
            <select name="id_type">
                <?php
                    foreach($datatype as $cle => $type)
                    echo '<option value="' . $type["id"]. '">' . $type['type'] . '</option>'
                    ?>
            </select>
        
            <input type="hidden" name="id" value="<?= $data["id"] ?>">
            <input type="submit" value="Modifier ma bouteille" class="modifierBouteille" />

        </div>
</div>
