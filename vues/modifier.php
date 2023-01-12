<div class="modifier">
<?php
foreach ($data as $cle => $bouteille) {
?>
    <div class="modifBouteille" vertical layout>
        
            <div class="formFak">
                <p>Nom : <input readonly name="nom" value="<?php echo $bouteille['nom'] ?>"></p></p>
                <p>Millesime : <input name="millesime" value="<?php echo $bouteille['millesime'] ?>"></p>
                <p>Quantite : <input name="quantite" value="<?php echo $bouteille['quantite'] ?>"></p>
                <p>Date achat : <input name="date_achat" value="<?php echo $bouteille['date_achat'] ?>"></p>
                <p>Prix : <input name="prix" value="<?php echo $bouteille['prix'] ?>"></p>
                <p>Garde : <input name="garde_jusqua" value="<?php echo $bouteille['garde_jusqua'] ?>"></p>
                <p>Notes <input name="notes" value="<?php echo $bouteille['notes'] ?>"></p>

                <button name="modifierBouteilleCellier">Modifier la bouteille (champs tous obligatoires)</button>
            </div>
            
        </div>
    </div>
    <?php } ?>
</div>
