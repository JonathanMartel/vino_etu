<div class="ajouter">

    
    
    
    <div class="form-style-8" style="padding-top: 50px;">
        
    <h2>Ajout d'une bouteille privé dans un cellier</h2>
        <div class="form-style-8" style="padding-top: 0;">
            <form action="?requete=ajouterNouvelleBouteilleCellierPrive" method="post">
            Choisissez un cellier:
            <select name="id_cellier">
                <?php
                    foreach($data as $cle => $cellier)
                    echo '<option value="' . $cellier["id"]. '">Cellier: ' . $cellier['nom'] . '</option>'
                    ?>
            </select>
                <input type="text" name="nom" placeholder="Nom" />
                <input type="text" name="millesime" placeholder="Millesime" />
                <input type="text" name="quantite" placeholder="Quantite" />
                <input type="text" name="date_achat" placeholder="Date d'achat" />
                <input type="text" name="prix_achat" placeholder="Prix"/>
                <input type="text" name="garde_jusqua" placeholder="Garde jusqu'a"/>
                <input type="text" name="notes" placeholder="Notes" />
                <input type="text" name="pays" placeholder="Pays" />
                <input type="text" name="id_type" placeholder="Type" />
                
                <input type="submit" value="Ajouter le Cellier" class="top"/>

            </form>
        </div>
    </div>
</div>