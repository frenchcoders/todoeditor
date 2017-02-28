/* * * * * * * * * * * * * * * * * * * * * * * * * *
 * GESTION DES EVENEMENTS SUR L'EDITEUR DE TODO-LIST
 * * * * * * * * * * * * * * * * * * * * * * * * * */
var UI = {

	toUpdateId:0, // lorsqu'il s'agit de la mise à jour d'un élément, contient l'id
				  // du jeu de données qui le représente.
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	// = = = = = = = = = = = = = = = = =
	// -> INITIALISATION DE L'INTERFACE
	// = = = = = = = = = = = = = = = = =


	init:function() {

		// * * * * * * * * * * * * * * * * * * * * * * * * *
		// CLICK SUR LE BOUTON DE CREATION D'UNE TODO-LIST
		// * * * * * * * * * * * * * * * * * * * * * * * * *
		$('.todolist-add').click(function() {

			var name = $('.todolist-name').val(); // nom de la todo-list
			var description = $('.todolist-description').val(); // description de la todo-list
			// - - - - - - - - - - - - - - - - - -

			if(name.length > 0 && description.length > 0) {
				// Ajout ou mise à jour du jeu de données en cours d'édition
				Queries.addTodoList(name, description, UI.toUpdateId);

				// S'il s'agit de modifier un jeu de données, on termine cette
				// modification par reset de l'id stocké par l'objet :
				UI.toUpdateId = 0;
			}

			else {
				// Erreur
				window.alert('Veuillez vérifier votre saisie ! ')
				return false;
			}
		})
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


		// * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		// CLICK SUR LE BOUTON D'AJOUT D'UN ELEMENT A UNE TODOLIST
		// * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		$('.add').click(function() {

			var todolistId = $('.todolist-id').val(); // id de la todo-list à laquelle appartient l'élément
			var title = $('.elem-title').val() // titre de la todo-list

			// Ajout effectif de l'élément de todo-list.
			Queries.addTodoElem(todolistId, title, UI.toUpdateId);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// Reset de l'élément id stocké si nécéssaire
			UI.toUpdateId = 0;

		})

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		// * * * * * * * * * * * * * * * * * * * * * * * * *
		// BOUTON DE RESET LORSQU'IL S'AGIT DE MODIFICATIONS
		// * * * * * * * * * * * * * * * * * * * * * * * * *
		$('.modifying-elem').find('i').click(function() {
			$(this).parent().addClass('no-display');
			UI.reset();
		})

	},
	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =


	// = = = = = = = = = = = = = = = = =
	// -> ELEMENTS CREES DYNAMIQUEMENT
	// = = = = = = = = = = = = = = = = =


	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	// MISE EN PLACE DE LA LISTE DES TODO-LISTS SUR L'INTERFACE
	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	setTodoLists: function(res) {

		// Reset du tableau des résultats pour la liste des todo-lists.
		var tableBody = $('.todolists-table').find('tbody'); // corps du tableau
		tableBody.html(''); // reset des contenus potentiels du tableau

		if(res.length > 0) {

			// Masquer le message " Il n'y a rien à afficher " si nécéssaire
			$('.todolists-nts').hide();

			// Boucle d'affichage des résultats
			var i = 1;
			for(key in res) {

				var row = $('<tr>').attr('data-todolist-id', res[key].id); // ligne
				var indexCell = $('<td>').text(i); // numéro de l'ocurence
				var titleCell = $('<td>').text(res[key].title).addClass('medium title-cell'); // cellule du titre
				var descriptionCell = $('<td>').text(res[key].description).addClass('description-cell'); // cellule de la description
				var dateCell = $('<td>').text(res[key].timestamp); // date d'insertion
				var modifyCell = $('<td>').html($('<i>').addClass('fa fa-lg fa-edit modify-todolist pointer')); // modifier

				// Suppression
				var deleteCell = $('<td>').html($('<i>').addClass('fa fa-lg fa-close delete-todolist pointer'));

				// Afficher les données
				var viewCellLink = $('<a>').attr('href', 'index.php?id=' + res[key].id).append($('<i>').addClass('fa fa-lg fa-eye'));
				var viewCell = $('<td>').append(viewCellLink);

				// Construire le tableau
				row.append(indexCell).append(titleCell).append(descriptionCell).append(dateCell).append(modifyCell).append(deleteCell).append(viewCell);
				tableBody.append(row);
				// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

				$('.todolists-table').fadeIn(); // Afficher le tableau
				i++;
			}
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


			// * * * * * * * * * * * * * * * * * * * * *
			// EVENEMENTS SUR LES BOUTONS DE SUPPRESSION
			// * * * * * * * * * * * * * * * * * * * * *
			$('.delete-todolist').each(function() {

				$(this).click(function() {
					var todolistId = parseInt($(this).parent().parent().attr('data-todolist-id'));

					var res = confirm("Etes-vous sûr de vouloir supprimer cet élément ?");
					if(res) {
						Queries.deleteTodolist(todolistId);
					}
				})
			})
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


			// * * * * * * * * * * * * * * * * * * * * * *
			// EVENEMENTS SUR LES BOUTONS DE MODIFICATION
			// * * * * * * * * * * * * * * * * * * * * * *
			$('.modify-todolist').each(function() {

				$(this).click(function() {
					var name = $('.todolist-name'); // champ du nom de la todo-list
					var description = $('.todolist-description'); // champ de la description de la todo-list

					var row = $(this).parent().parent();
					var todolist_id = parseInt(row.attr('data-todolist-id'));
					var titleText = row.find('.title-cell').text();
					var descriptionText = row.find('.description-cell').text();

					// Mise en place des données à modifier dans les champs qui les concernent
					name.val(titleText);
					description.val(descriptionText);

					// Affichage visuel mode " modifications "
					$('.modifying-elem').removeClass('no-display');

					// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

					// STOCKAGE DE L'ID DU JEU DE DONNEES A MODIFIER
					UI.toUpdateId = todolist_id;

				})
			})
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		}

		else {
			// Il n'y a pas de valeurs à aficher.
			$('.todolists-table').hide();
			$('.todolists-nts').fadeIn();
		}
	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	// AFFICHER LES ELEMENTS APPARTENANT A UNE TODO-LIST SUR L'INTERFACE
	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	setTodoElems:function(res, needToScroll) {

		// Reset du tableau de la liste des éléments de tâches
		$('#todolist-elems').html('');

		// Boucle pour l'affichage des éléments
		for(key in res) {


			// * * * * * * * * * * * * * * * *
			// ELEMENT DE LA LISTE DES TACHES
			// * * * * * * * * * * * * * * * *
			var li = $('<li>').html(res[key].title).attr('data-elem-id', res[key].id);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// * * * * * * * * * * * * * * * * * *
			// BOUTON DE MODIFICATION DE L'ELEMENT
			// * * * * * * * * * * * * * * * * * *
			var modifyBtn = $('<i>').addClass('todoelem-modify fa fa-lg fa-edit').click(function(e) {

				e.stopPropagation();
				var id = $(this).parent().attr('data-elem-id');
				var text = $(this).parent().text();

				// CONTENU DE L'ELEMENT DANS LE CHAMP DE TEXTE
				$('.elem-title').val(text);

				// Affichage visuel mode " modifications "
				$('.modifying-elem').removeClass('no-display');
				// - - - - - - - - - - - - - - - - - - - -

				// STOCKAGE DE L'ID DE L'ELEMENT A MODIFIER
				UI.toUpdateId = id;
			});

			li.append(modifyBtn);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// * * * * * * * * * * * * * * * * * *
			// BOUTON DE SUPPRESSION DE L'ELEMENT
			// * * * * * * * * * * * * * * * * * *
			var deleteBtn =  $('<i>').addClass('close fa fa-lg fa-close').on('click', function(e) {
				e.stopPropagation(); // empêcher l'évènement de séléction / désélection de se produire
				var res = confirm("Voulez vous supprimer cet élément ?");
				if(res) {
					// Suppression effective de l'élément
					Queries.deleteTodoElem($(this).parent().attr('data-elem-id'));
				}
			})
			li.append(deleteBtn);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// * * * * * * * * * * * * * * * * *
			// EVENEMENT DE TOGGLE DE L'ELEMENT
			// * * * * * * * * * * * * * * * * *
			li = UI.setLiEvent(li);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// * * * * * * * * * * * * * * * * * * * * * * *
			// STATUS DE L'ELEMENT AU MOMENT DE L'AFFICHAGE
			// * * * * * * * * * * * * * * * * * * * * * * *
			if(parseInt(res[key].status) == 1) {
				$(li).addClass('checked');
			}
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// * * * * * * * * * * * * * * * *
			// AJOUT DE L'ELEMENT DANS LE DOM
			// * * * * * * * * * * * * * * * *
			$('#todolist-elems').append(li);
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		}

		// * * * * * * * * * * * * * * * * * *
		// SCROLLER AU DERNIER ELEMENT AJOUTE
		// * * * * * * * * * * * * * * * * * *
		console.log(needToScroll)
		if(needToScroll) {
			  $("html, body").animate({ scrollTop: $(document).height()-$(window).height() }, 100);
			  UI.animateLastElem();
		}
	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	// SELECTION / DESELECTION SUR LES EVENEMENTS DE LISTE DE TACHES
	// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	setLiEvent: function(elem) {

		$(elem).click(function() {

			// Séléction de l'élément
			if($(this).hasClass('checked')) {
				Queries.status($(this).attr('data-elem-id'), 0);
				$(this).removeClass('checked');
			}

			// Désélection de l'élément
			else {
				Queries.status($(this).attr('data-elem-id'), 1);
				$(this).addClass('checked');
			}
		})

		// Renvoyer l'élément avec l'évènement attaché
		return $(elem);
	},
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	// * * * * * * * * * * * * * * * * * * * *
	// ANIMATION SUR LE DERNIER ELEMENT AJOUTE
	// * * * * * * * * * * * * * * * * * * * *
	animateLastElem:function() {

		$('ul li:last').addClass('success');

		var timer = setTimeout(function() {
			$('ul li:last').removeClass('success');
		}, 5000);
	},
	// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	// = = = = = = = =
	// -> INCLASSABLES
	// = = = = = = = =

	// * * * * * * * * * * * * * * * * * * *
	// RESET DES CONTENUS DE CHAMPS TEXTUELS
	// * * * * * * * * * * * * * * * * * * *
	reset: function() {

		// RESET DES CHAMPS
		var todoName = $('.todolist-name'); // champ du nom de la todo-list
		var todoDescription = $('.todolist-description'); // champ de la description de la todo-list
		var elemTitle = $('.elem-title'); // champ d'ajout d'élément de todolist

		if(todoName.length) {
			todoName.val('');
		}

		if(todoDescription.length) {
			todoDescription.val('');
		}

		if(elemTitle.length) {
			elemTitle.val('');
		}
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		// RESET DU MODE DE MODIFICATION
		if(UI.toUpdateId) {
			UI.toUpdateId = 0;
		}
	}
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

}

// = = = = = = = = = = = = = = = = = = = = = = = = = = =
// MISE EN PLACE DES EVENEMENTS AU CHARGEMENT DU SCRIPT
// = = = = = = = = = = = = = = = = = = = = = = = = = = =
$(document).ready(function() {
	UI.init();
})
