
<div class="form-style-8">
	<h2>Modifier Vos information</h2>
	<form action="?requete=profilmod" method="post" id="modProfilForm">
    <span id="nom" class="error-message"></span>
    <input type="text" name="nom" value="<?= $_SESSION['usager'][0]['nom'] ?>" />
    <button type="submit" class="top button-28">Modifier</button>
  </form>
</div>

