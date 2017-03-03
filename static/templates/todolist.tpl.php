<!--
* * * * * * * * * * * * * * * * * *
TEMPLATE DE L'EDITION DE TODO-LIST
* * * * * * * * * * * * * * * * * * -->

<!--
* * * *
HEADER
* * * * -->
<div class="jumbotron header no-mrg-btm">

	<h1 class="display-3">Eléments de liste de tâches</h1>

	<p class="lead">
		Pour éditer un élément de liste de tâche, veuillez renseigner sa description ci-dessous.
		<hr class="my-3"></p>

	<p>
		<!-- ID de la todo-list auquel appartient l'élément -->
		<input type="hidden"
			   class="todolist-id"
			   value="<?php echo intval($_GET['id']); ?>" />

		<!-- Nom de la tâche à ajouter -->
	  	<input type="text"
			   class="left elem-title form-control form-control-lg"
			   placeholder="Nom de la tâche à ajouter"><br />

		<!-- Indicateur de modification d'un élément -->
		<div class="modifying-elem no-display">Modification d'un élément <i class="fa fa-lg fa-close pointer"></i></div>

		<!-- Enregistrement / Retour -->
		<button class="add btn btn-lg btn-primary btn-mrg-top">Enregistrer les modifications</button>
		<a href="index.php" class="btn btn-secondary btn-lg btn-mrg-top">Retour</a>
    </p>

</div>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->


<!--
* * * * * * * * * * * * * * *
ELEMENTS DE LA LISTE DE TACHE
* * * * * * * * * * * * * * *
-->
<div class="container-fluid">

	<div class="row">
		<div class="col-lg-12 no-pdg">
			<!-- ELEMENTS DE TODOLISTS INSERES DYNAMIQUEMENT VIA JAVASCRIPT -->
			<ul id="todolist-elems"></ul>
		</div>
	</div>
</div>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->


<script>
$(document).ready(function() {
	Queries.fetchTodoElems($('.todolist-id').val(), 0);
});
</script>
