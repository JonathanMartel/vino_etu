<div class="modifier">
    
        
        <div class="form-style-8" style="padding-top: 50px;">        
            <h2>Modification bouteille saq</h2>
            Choisissez un cellier:
            <select name="id_cellier">
                <?php
                    foreach($datacell as $cle => $cellier)
                    echo '<option value="' . $cellier["id"]. '">Cellier: ' . $cellier['nom'] . '</option>'
                    ?>
            </select>         
            Date d'achat:
            <input type="date" name="date_achat" value="<?= $data["date_achat"] ?>" />
            Garde jusqu'a:
            <input type="date" name="garde_jusqua" value="<?= $data["garde_jusqua"] ?>" />
            Millesime:
            <input type="text" name="millesime" value="<?= $data["millesime"] ?>" />
            Notez sur 10:
            <input type="text" name="notes" value="<?= $data["notes"] ?>" />
    
            <input type="hidden" name="id" value="<?= $data["id"] ?>">

            <button type="submit" class="modifierBouteillesaq top button-28">Modifier ma bouteille</button>


        </div>
</div>
