<!-- </main>
<footer>
	<h2>Vino 2023 ©</h2>
</footer>
</body>

</html> -->
</main>
<footer style="display: none;">
	<nav>
		<?php
		if(!$_SESSION) echo '<h3><a href="?requete=login" class="btnlogin button-28">Se connecter</a></h3>';
		?>
		<?php
		if($_SESSION) echo '<h3><a href="?requete=profil" class="btnlogin button-28">Profil</a><a href="?requete=listecellier" class="btnlogin button-28">Liste Celliers</a><a href="?requete=deconnexion" class="btnlogin button-28">Déconnexion</a></h3>';
		?>
		
	</nav>
</footer>
</body>

</html>