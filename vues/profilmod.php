
<div class="form-style-8">
	<h2>Modifier Vos information</h2>
	<form action="?requete=profilmod" method="post">
    <input type="text" name="nom" value="<?= $_SESSION['usager'][0]['nom'] ?>" />
    <input type="submit" value="Modifier" class="top"/>
  </form>
</div>

