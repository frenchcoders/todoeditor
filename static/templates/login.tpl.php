<!--
* * * * * * * * * * * * * * * * * * * * * * * *
TEMPLATE DE LA CONNEXION ET DE L'ENREGISTREMENT
* * * * * * * * * * * * * * * * * * * * * * * * -->

<!--
* * * *
HEADER
* * * * -->
<div class="jumbotron header">

	<h1 class="display-3">Espace reservé</h1>
	
	<p class="lead">Cet espace est réservé aux utilisateurs enregistrés et connectés.<hr class="my-4" /></p>
	<p>Pour utiliser l'éditeur de liste de tâche, vous devez d'abord vous connecter avec vos identifiants ou vous enregistrer.</p>

</div>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<h1>S'enregistrer</h1>

			<form method="POST">
				<p>
					<input type="hidden" name="action" value="register" />

					<input type="text" class="form-control form-control-lg" name="email" placeholder="Adresse e-mail" /><br />
					<input type="text" class="form-control form-control-lg" name="username" placeholder="Nom d'utilisateur" /><br />
					<input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe" /><br />

					<input type="submit" class="btn btn-lg btn-primary" value="Enregistrement" />
				</p>
			</form>
		</div>
		<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

		<div class="col-lg-6">
			<h1>Se connecter</h1>
			<form method="POST">
				<p>
					<input type="hidden" name="action" value="login" />
					<input type="text" class="form-control form-control-lg" name="username" placeholder="Nom d'utilisateur" /><br />
					<input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe" /><br />

					<input type="submit" class="btn btn-lg btn-primary"  value="Connexion" />
				</p>
			</form>
		</div>

	</div>
</div>
