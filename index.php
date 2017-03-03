<?php
# * * * * * * * * * * * * * * * * * *
# CONTROLEUR PRICIPAL DU TODOEDITOR
# * * * * * * * * * * * * * * * * * *

include('config.php');
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

if(!$_Users->status()):

	# = = = = = = = = = = = = = = = = =
	# L'UTILISATEUR N'EST PAS CONNECTE
	# = = = = = = = = = = = = = = = = =
	include('static/templates/header.tpl.php');
	include('static/templates/login.tpl.php');

	if(isset($_POST['action']) && $_POST['action'] == 'login' && isset($_POST['username']) && isset($_POST['password'])):

		# * * * * *
		# CONNEXION
		# * * * * *
		$d = $_Users->login($_POST['username'], $_POST['password']);

		if($d):
			header('Location: index.php');
			exit();
		endif;
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	elseif(isset($_POST['action']) && $_POST['action'] == 'register' && isset($_POST['email']) && isset($_POST['username'])
		&& isset($_POST['password'])):

		# * * * * * * * *
		# ENREGISTREMENT
		# * * * * * * * *
		$_Users->register($_POST['email'], $_POST['username'], $_POST['password']);

	endif;

elseif(!isset($_GET['id'])):

	# = = = = = = = = = = = = = =
	# LISTE DES LISTES DES TACHES
	# = = = = = = = = = = = = = =
	include('static/templates/header.tpl.php');
	include('static/templates/home.tpl.php');
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

else:

	# = = = = = = = = = = = = = = =
	# AFFICHER UNE LISTE DE TACHES
	# = = = = = = = = = = = = = = =
	include('static/templates/header.tpl.php');
	include('static/templates/todolist.tpl.php');

endif;
?>
