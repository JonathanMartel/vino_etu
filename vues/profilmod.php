
<div class="form-style-8">
	<h1>Modifier Vos information</h1>
	<form action="?requete=profilmod" method="post">
    <input type="text" name="nom" value="<?= $_SESSION['usager'][0]['nom'] ?>" />
    <input type="text" name="email" value="<?= $_SESSION['usager'][0]['email'] ?>" />
    <input type="submit" value="Mofifier" class="top"/>
  </form>
</div>

