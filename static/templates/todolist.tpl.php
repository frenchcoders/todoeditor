<!--
* * * * * * * * * * * * * * * * * *
TEMPLATE DE L'EDITION DE TODO-LIST
* * * * * * * * * * * * * * * * * * -->
<div id="header" class="header">
  <div class="go-back">
	  <a href="index.php">
	  		<i class="fa fa-lg fa-arrow-left"></i>
	  </a>
  </div>
  <h1>TODO A AJOUTER</h1>

	<input type="hidden" class="todolist-id" value="<?php echo intval($_GET['id']); ?>" />
  	<input type="text" class="left elem-title" id="tache" placeholder="LA TACHE A FAIRE ...">
  	<span class="add">
		<i class="fa fa-plus fa-2x" aria-hidden="true"></i>
  	</span>

	<div class="modifying-elem no-display">Modification d'un élément <i class="fa fa-lg fa-close pointer"></i></div>


</div>

<ul id="todolist-elems">
  <!-- LES LI -->
</ul>

<script>
$(document).ready(function() {
	Queries.fetchTodoElems($('.todolist-id').val(), 0);
});
</script>
