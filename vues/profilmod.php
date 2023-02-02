
<div class="form-style-8">
	<h2>Modifier Vos information</h2>
	<form action="?requete=profilmod" method="post">
  <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value="<?= $_SESSION['usager'][0]['nom'] ?>" />
    <label for="email">Courriel</label>
    <input type="email" name="email" id="email" value="<?= $_SESSION['usager'][0]['email'] ?>" />
    <label for="mdp" >Nouveau mot de passe</label>
    <input type="password" name="mdp" id="mdp" />
    <label for="mdpConfirm">Confirmer mot de passe</label>
    <input type="password" name="mdpConfirm" id="mdpConfirm">

    <button type="submit" class="top button-28">Modifier</button>
  </form>
</div>

