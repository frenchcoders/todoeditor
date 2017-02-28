<!---
* * * * * * * * * * * * * * * * * * * *
HOMEPAGE DE L'EDITION DES TODO-LISTS
* * * * * * * * * * * * * * * * * * * * -->
<div id="header" class="header">

  <h1>NOUVELLE TODO-LIST</h1>

  	<input type="text" id="tache" class="todolist-name mrg-auto" placeholder="NOM DE LA TODO-LIST">
	<textarea class="todolist-description mrg-auto" placeholder="DESCRIPTION DE LA TODO-LIST"></textarea>

  	<div class="todolist-add mrg-auto">
		<i class="fa fa-plus fa-2x" aria-hidden="true"></i>
  	</div>

	<div class="modifying-elem home-modifying no-display">Modification d'un élément <i class="fa fa-lg fa-close pointer"></i></div>

</div>

<table class="todolists-table no-display">
	<thead>
		<tr>
			<th>#</th>
			<th>Titre</th>
			<th>Description</th>
			<th>Créée le</th>
			<th>Modifier</th>
			<th>Supprimer</th>
			<th>Afficher</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<p class="todolists-nts no-display">Il n'y a rien à afficher ! <br />
<span class="small">Vous pouvez à tout moment créer votre première liste de tâches en utilisant le formulaire ci-dessus.</span></p>

<script>
$(document).ready(function() {
	// Chargement initial de la liste des todo-lists
	Queries.fetchTodoLists();
})
</script>
