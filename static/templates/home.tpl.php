<!---
* * * * * * * * * * * * * * * * * * * *
HOMEPAGE DE L'EDITION DES TODO-LISTS
* * * * * * * * * * * * * * * * * * * * -->

<!--
* * * *
HEADER
* * * * -->
<div class="jumbotron header">

	<h1 class="display-3">Listes de tâches</h1>
	<p class="lead">
		Pour éditer les informations d'une liste de tâches, veuillez renseigner la valeur des champs ci-dessous.
		<hr class="my-3" />
	</p>

	<p>
		<!-- Titre de la liste de tâches -->
		<input type="text" id="tache"
						   class="todolist-name form-control form-control-lg"
						   placeholder="Nom de la liste de tâches"> <br />

		<!-- Description de la liste de tâches -->
		<textarea class="todolist-description form-control form-control-lg"
				  placeholder="Description de la liste de tâches"></textarea>
	</p>

	<!-- DOM de l'indicateur de modification d'élément si nécéssaire -->
	<div class="modifying-elem home-modifying no-display">
		Modification d'un élément <i class="fa fa-lg fa-close pointer"></i>
	</div>

	<button class="btn btn-primary btn-lg todolist-add">Enregistrer les modifications</button>

</div>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

<!--
* * * * * * * * * * * * * *
LISTE DES LISTES DE TACHES
* * * * * * * * * * * * * * -->
<div class="container-fluid">

	<div class="row">
		<div class="col-lg-12">

			<table class="todolists-table table table-bordered no-display">
				<thead class="table-inverse">
					<tr>
						<th>#</th>
						<th class="text-center">Titre</th>
						<th class="text-center">Description</th>
						<th class="text-center">Créée le</th>
						<th class="text-center">Modifier</th>
						<th class="text-center">Supprimer</th>
						<th class="text-center">Afficher</th>
					</tr>
				</thead>

				<!-- @NOTE : Corps du tableau inséré dynamiquement via Javascript -->
				<tbody></tbody>
			</table>
		</div>
	</div>

	<p class="todolists-nts no-display">Il n'y a rien à afficher ! <br />
	<span class="small">Vous pouvez à tout moment créer votre première liste de tâches en utilisant le formulaire ci-dessus.</span></p>

</div>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

<script>
$(document).ready(function() {
	// Chargement initial de la liste des todo-lists
	Queries.fetchTodoLists();
})
</script>
