
<section class="newletter formCo enchereForm">

    <form class='inscCo' data-js-form action="" enctype="multipart/form-data" method="post">

        <h5 class="form-title">Ajouter une bouteille</h5><br>

        Nom <input type="text" name="" required>
        Millesime <input type="text" name="millesime" required>
        quantite <input type="text" name="quantite" value='1' required>
        Date achat  <input type="text" name="Date achat " required>
        Garde <input type="text" name="Garde" required>

        Cellier <select name="" class="trier select" value="trier par" required>
            <option ></option>
            <option value="t">cuisine</option>
            <option value="">chalet</option>
            <option value="">spa</option>
            
        </select><br>

        Image(s) <input name="img_nom" type="file" accept=".jpg, .jpeg, .png" required>
        Prix <input type="number" name="" required>
        Notes <input type="textarea" name="Notes" required>
 

        <button name="ajouterBouteilleCellier">ajouter</button><br>
        <span id="erreur" style="color: red;"></span>

    </form>


</section>