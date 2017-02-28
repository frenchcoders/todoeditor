<?php
# * * * * * * * * * * * * * * * * * *
# TRAITEMENT DES REQUETES ASYNCHRONES
# * * * * * * * * * * * * * * * * * *
include('config.php');
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# = = = = = = = = = = = = = = = = = =
# -> METADONNEES DES LISTES DE TACHES
# = = = = = = = = = = = = = = = = = =


# * * * * * * * * * * * * * * * * * * * * * * * * * * * *
# AJOUT / MODIFICATION DE TODO-LISTS EN BASE DE DONNEES
# * * * * * * * * * * * * * * * * * * * * * * * * * * * *
if(isset($_POST['action']) && $_POST['action'] == 'addTodoList'
   && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['id'])):

	$id = intval($_POST['id']);

	# AJOUT D'UN NOUVEAU JEU DE DONNEES
	if(!$id):

		# REQUETE SQL
		$SQL = 'INSERT INTO todolists VALUES(\'\', :title, :desc, :timestamp)';
		$r = $_PDO->prepare($SQL);

		$r->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
		$r->bindValue(':desc', $_POST['description'], PDO::PARAM_STR);
		$r->bindValue(':timestamp', time(), PDO::PARAM_INT);

		$d = $r->execute();
		$r->closeCursor();
		# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		# RETOUR SERVEUR
		echo intval($d);
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


	# MODIFICATION D'UN JEU DE DONNEES EXISTANT
	else:

		# REQUETE SQL
		$SQL = 'UPDATE todolists SET title=:title, description=:description '
			   . 'WHERE id=:id';

		$r = $_PDO->prepare($SQL);

		$r->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
		$r->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$r->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

		$d = $r->execute();
		$r->closeCursor();
		# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		# RETOUR SERVEUR
		echo intval($r);
	endif;

endif;
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# * * * * * * * * * * * * * * * * * * * * * * * * * *
# SUPPRIMER UNE LISTE DE TACHES DE LA BASE DE DONNEES
# * * * * * * * * * * * * * * * * * * * * * * * * * *
if(isset($_POST['action']) && $_POST['action'] == 'deleteTodolist' && isset($_POST['id'])):

	# SUPPRESSION DE LA LISTE DE TACHE
	$SQL = 'DELETE FROM todolists WHERE id=:id';
	$r = $_PDO->prepare($SQL);

	$r->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
	$d = $r->execute();
	$r->closeCursor();

	if($d !== false):

		# SUPPRESSION DES ELEMENTS ASSOCIES A LA LISTE DE TACHE
		$SQL = 'DELETE FROM todoelems WHERE todolist_id = :id';
		$r = $_PDO->prepare($SQL);

		$r->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
		$d = $r->execute();
		$r->closeCursor();

	endif;

	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	# RETOUR SERVEUR
	echo intval($d);
endif;
# - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# * * * * * * * * * * * * * * * * * * * * * * * * * * *
# LISTE DES LISTES DE TACHES DEPUIS LA BASE DE DONNEES
# * * * * * * * * * * * * * * * * * * * * * * * * * * *
if(isset($_POST['action']) && $_POST['action'] == 'todolists-list'):

	# REQUETE SQL
	$SQL = 'SELECT id, title, description, timestamp FROM todolists';
	$r = $_PDO->query($SQL);
	$res = $r->fetchAll(PDO::FETCH_ASSOC);
	$r->closeCursor();
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	# RETOUR SERVEUR
	echo json_encode($res);

endif;
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =


# = = = = = = = = = = = = = = = = = = = = = = =
# -> ELEMENTS APPARTENANTS AUX LISTES DE TACHES
# = = = = = = = = = = = = = = = = = = = = = = =


# * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
# RECUPERER LA LISTE DES ELEMENTS APPARTENANT A UNE LISTE DE TACHE
# * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
if(isset($_POST['action']) && $_POST['action'] == 'fetchTodoElems' && isset($_POST['id'])):

	# REQUETE SQL
	$SQL = 'SELECT id, title, status, timestamp FROM todoelems'
		.  ' WHERE todolist_id = :id';

	$r = $_PDO->prepare($SQL);

	$r->bindValue(':id', intval($_POST['id']), PDO::PARAM_INT);
	$r->execute();
	$res = $r->fetchAll(PDO::FETCH_ASSOC);
	$r->closeCursor();
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	# RETOUR SERVEUR
	echo json_encode($res);

endif;
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# * * * * * * * * * * * * * * * * * * * * *
# AJOUTER UN ELEMENT A UNE LISTE DES TACHES
# * * * * * * * * * * * * * * * * * * * * *
if(isset($_POST['action']) && $_POST['action'] == 'addTodoElem' && isset($_POST['todolist_id'])
  && isset($_POST['title']) && isset($_POST['id'])):

	$id = intval($_POST['id']);

	# INSERTION D'UN NOUVEL ELEMENT
	if(!$id):

		# REQUETE SQL
		$SQL = 'INSERT INTO todoelems VALUES(\'\', :title, :todo_id, :status, :timestamp)';
		$r = $_PDO->prepare($SQL);

		$r->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
		$r->bindValue(':todo_id', $_POST['todolist_id'], PDO::PARAM_INT);
		$r->bindValue(':status', 0, PDO::PARAM_INT);
		$r->bindValue(':timestamp', time(), PDO::PARAM_INT);

		$d = $r->execute();
		$r->closeCursor();
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	# MODIFICATION D'UN ELEMENT EXISTANT
	else:

		# REQUETE SQL
		$SQL = 'UPDATE todoelems SET title = :title WHERE id = :id';
		$r = $_PDO->prepare($SQL);

		$r->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
		$r->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

		$d = $r->execute();
		$r->closeCursor();

	endif;

	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	# RETOUR SERVEUR
	echo intval($d);

endif;

# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# * * * * * * * * * * * * * * * * * * * * * * * * *
# MOIFIER LE STATUS D'UN ELEMENT DE LISTE DE TACHE
# * * * * * * * * * * * * * * * * * * * * * * * * *
if(isset($_POST['action']) && $_POST['action'] == 'updateStatus'
	&& isset($_POST['id']) && isset($_POST['status'])):

	# REQUETE SQL
	$SQL = 'UPDATE todoelems SET status=:status WHERE id=:id';
	$r = $_PDO->prepare($SQL);

	$r->bindValue(':status', $_POST['status'], PDO::PARAM_INT);
	$r->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

	$d = $r->execute();
	$r->closeCursor();
	# -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	# RETOUR SERVEUR
	echo intval($d);

endif;
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# * * * * * * * * * * * * * * * * * * * * * * * * * * *
# SUPPRESSION EFFECTIVE D'UN ELEMENT DE LISTE DE TACHES
# * * * * * * * * * * * * * * * * * * * * * * * * * * *
if(isset($_POST['action']) && $_POST['action'] == 'deleteElem' && isset($_POST['id'])):

	# REQUETE SQL
	$SQL = 'DELETE FROM todoelems WHERE id =:id';
	$r = $_PDO->prepare($SQL);

	$r->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
	$d = $r->execute();
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	# RETOUR SERVEUR
	echo intval($d);

endif;
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
