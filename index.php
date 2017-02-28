<?php
# * * * * * * * * * * * * * * * * * *
# CONTROLEUR PRICIPAL DU TODOEDITOR
# * * * * * * * * * * * * * * * * * *

include('config.php');
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =


if(!isset($_GET['id'])):

	include('static/templates/header.tpl.php');
	include('static/templates/home.tpl.php');

else:

	include('static/templates/header.tpl.php');
	include('static/templates/todolist.tpl.php');

endif;

?>
