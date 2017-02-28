/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * REQUETES ASYNCHRONES POUR L'INTERFACE DE GESTION DES TODO-LISTS
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
var Queries = {

	// ID DE LA DERNIERE LISTE DE TACHE AVEC LAQUELLE ON TRAVAILLE.
	lastTodoListId: 0,

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	// = = = = = = = = = = = = = = = = = = = = = =
	// -> RELATIF AUX METADONNEES DES TODO-LISTS
	// = = = = = = = = = = = = = = = = = = = = = =


	// * * * * * * * * * * * *
	// LISTE DES TODO-LISTS
	// * * * * * * * * * * * *
	fetchTodoLists: function() {

		$.ajax({
					url:'async.php',
					method:'POST',

					data: { action:"todolists-list" },

					success:function(res) {
						res = JSON.parse(res);
						UI.setTodoLists(res);
					},

					error:function() {
						console.log('fetchTodoLists - AJAX ERROR.');
					}
		})

	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	/* * * * * * * * * * * * * * * * * * * * * * *
	 * AJOUTER UNE TODO-LIST EN BASE DE DONNEES
	 * * * * * * * * * * * * * * * * * * * * * * * */
	addTodoList: function(title, description, id) {

		// REQUETE POUR ETABLIR LA LISTE DES TODO-LISTS
		$.ajax({
					url:'async.php',
					method:'POST',

					data: { action:'addTodoList', title:title,
							description:description, id:id },

					success:function(res) {
						Queries.fetchTodoLists($('.todolist-id').val());
						UI.reset();
					},

					error:function() {
						console.log('Ajax error.');
					}
		})

	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	// * * * * * * * * * * * * *
	// SUPPRIMER UNE TODO-LIST
	// * * * * * * * * * * * *
	deleteTodolist:function(id) {

		Queries.lastTodoListId = parseInt(id);

		$.ajax({
					url:'async.php',
					method:'POST',

					data:{action:'deleteTodolist', id:Queries.lastTodoListId},

					success: function(res) {
						console.log(res);
						Queries.fetchTodoLists();
					},

					error:function() {
						console.log("deleteTodolist - AJAX ERROR.");
					}
		});

	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =



	// = = = = = = = = = = = = = = = = = = = = = = = = = = =
	// -> RELATIFS AUX ELEMENTS APPARTENANTS AUX TODO-LISTS
	// = = = = = = = = = = = = = = = = = = = = = = = = = = =


	// * * * * * * * * * * * * * * * * * * *
	// ELEMENTS APPARTENANTS AUX TODO-LISTS
	// * * * * * * * * * * * * * * * * * * *
	fetchTodoElems: function(id, needToScroll) {

		$.ajax({
					url:'async.php',
					method:'POST',

					data: { action:'fetchTodoElems', id:id },

					success:function(res) {
						res = JSON.parse(res);
						UI.setTodoElems(res, needToScroll); // mise en place
					},

					error:function() {
						console.log('fetchTodoElems - AJAX ERROR');
					}
		})
	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * AJOUTER UN ELEMENT DE TODO-LIST EN BASE DE DONNEES
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	addTodoElem: function(todolistId, title, id) {

		$.ajax({
					url:'async.php',
					method:'POST',

					data: { action:'addTodoElem', todolist_id:todolistId, title:title, id:id},

					success:function(res) {
						console.log(res)
						Queries.fetchTodoElems($('.todolist-id').val(), 1);
						UI.reset();
					},

					error:function() {
						console.log('addTodoElem - AJAX ERROR');
					}
		});
	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	/* * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * REQUETE POUR SUPPRESSION D'UN ELEMENT DE TODO-LIST
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	deleteTodoElem: function(id) {

		$.ajax({
					url:'async.php',
					method:'POST',

					data:{action:'deleteElem', id:id},

					success:function(res) {
						Queries.fetchTodoElems($('.todolist-id').val());
					},

					error:function() {
						console.log("deleteTodoElem - AJAX ERROR.")
					}
		})
	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	/* * * * * * * * * * * * * * * * * * * * * * * * *
	 * MODIFIER LE STATUS D'UN ELEMENT DE TODOLIST
	 * * * * * * * * * * * * * * * * * * * * * * * * */
	status: function(id, status) {

		$.ajax({
					url:'async.php',
					method:'POST',

					data: {action:'updateStatus', id:id, status:status},

					success:function(res) {
						console.log(res);
					},

					error:function() {
						console.log('status - AJAX ERROR !');
					}
		})
	}
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

}
