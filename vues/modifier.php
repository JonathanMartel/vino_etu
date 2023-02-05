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
        Nom: <br>
        <span id="nom" class="error-message"></span>    
        <input class="nom_bouteille" type="text" name="nom" value="<?= $data["nom"] ?>" />
        Millesime: <br>
        <span id="millesime" class="error-message"></span> 
        <input type="text" name="millesime" value="<?= $data["millesime"] ?>" />
        Quantité: <br>
        <span id="quantite" class="error-message"></span> 
        <input type="text" name="quantite" value="<?= $data["quantite"] ?>" />
        Date d'achat: <br>
        <span id="date_achat" class="error-message"></span> 
        <input type="date" name="date_achat" value="<?= $data["date_achat"] ?>" />
        Garde jusqu'à <br>
        <span id="garde_jusqua" class="error-message"></span> 
        <input type="text" name="garde_jusqua" value="<?= $data["garde_jusqua"] ?>" />
        Prix: <br>
        <span id="prix_achat" class="error-message"></span> 
        <input type="text" name="prix_achat" value="<?= $data["prix_achat"] ?>" />
        Note: <br>
        <span id="notes" class="error-message"></span> 
        <input type="text" name="notes" value="<?= $data["notes"] ?>" placeholder="1 sur 10"/>
        Pays: <br>
        <span id="pays" class="error-message"></span> 
        <input type="text" name="pays" value="<?= $data["pays"] ?>" />
        Choisissez un type:
        <select name="id_type">
            <?php
                foreach($datatype as $cle => $type)
                echo '<option value="' . $type["id"]. '">' . $type['type'] . '</option>'
                ?>
        </select>
    
        <input type="hidden" name="id" value="<?= $data["id"] ?>">

        <button type="submit" class="modifierBouteille top button-28">Modifier</button>


    </div>
</div>
