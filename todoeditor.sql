-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `todoelems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `todolist_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `todoelems` (`id`, `title`, `todolist_id`, `status`, `timestamp`) VALUES
(13,	'Suppressions des éléments de listes des tâches en même temps que la liste des tâches',	14,	1,	1488078145),
(14,	'Support de la connexion des utilisateurs',	14,	1,	1488078162),
(15,	'Ajouter le nom de l\'utilisateur qui a crée une liste des tâches à cette liste des tâches ',	14,	0,	1488078188),
(16,	'Suppression des listes des tâches ',	14,	1,	1488078197),
(17,	'Suppression des éléments de listes des tâches ',	14,	1,	1488078208),
(18,	'Modification métadonnées des listes des tâches',	14,	1,	1488078217),
(19,	'Modification des éléments de liste des tâches ',	14,	1,	1488078230),
(20,	'Curseur \" pointer \" sur les éléments cliquables',	14,	1,	1488078243),
(21,	'Titres adaptés dans les barres de titres sur tout le script',	14,	1,	1488078266),
(23,	'Liste de tâches publiques et privées',	14,	0,	1488078352),
(24,	'Commentaires sur les éléments de listes de tâches',	14,	0,	1488078400),
(25,	'Liste de tâches collaboratives / autorisations / invitations',	14,	0,	1488144260),
(26,	'Possibilité d\'annuler le mode \" modification \" sur les métadonnées de todolists',	14,	1,	1488147083),
(27,	'Possibilité d\'annuler le mode \" modification \" sur les éléments de listes des tâches',	14,	1,	1488147104),
(28,	'Bouton de retour à la page principale lors de la modification d\'une todolist',	14,	1,	1488147149),
(29,	'Compteur du nombre de tâches lors de l\'affichage d\'une todolist',	14,	1,	1488147169),
(30,	'Reset des champs après la validation de l\'ajout d\'une liste de tâche ou d\'un élément de liste de tâche',	14,	1,	1488147199),
(32,	'Ancres sur chaque élément de liste de tâche',	14,	1,	1488164386),
(33,	'Adapter le scroll lors de l\'ajout d\'un élément de todolist',	14,	1,	1488164424),
(34,	'Désactiver l\'autocomplete sur tous les champs textuels',	14,	0,	1488193458),
(44,	'Faire clignoter en vert les éléments de liste de tâches nouvellement ajoutés pour les mettre en valeur',	14,	1,	1488210878),
(63,	'Nettoyer les tables du script des éléments résiduels inutiles',	14,	1,	1488212092),
(64,	'Scrolltop lors du click sur le bouton \" modifier \" lors de l\'édition des éléments de listes de tâches',	14,	1,	1488212415),
(65,	'Uploader une version de production du script sur un serveur distant pour être utilisée en tant qu\'outil de productivité',	14,	0,	1488333980),
(66,	'Faire clignotter le bon élément de liste de tâche lors d\'une modification',	14,	1,	1488379946),
(67,	'Mise à jour du templates vers les codes standards fournis par BS4',	14,	1,	1488386398),
(68,	'Alertes succès / erreur sur la connexion et l\'enregistrement d\'utilisateurs',	14,	0,	1488508821),
(69,	'Correction de bug sur les couleurs des icones modifier / supprimer des éléments de liste de tâches',	14,	1,	1488508857),
(70,	'Réecrire la fonction de mise en valeur des éléments de listes de tâches pour préciser en paramètre l\'ID de l\'élément',	14,	1,	1488509039),
(73,	'Déconnexion de l\'utilisateur',	14,	0,	1488514124);

CREATE TABLE `todolists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `todolists` (`id`, `title`, `description`, `timestamp`) VALUES
(14,	'Tâches à accomplir en vue de finaliser une première version du script de gestion de listes des tâches',	'Tâches à accomplir pour améliorer et finaliser le script de gestion de liste de tâches co-écrit par @Thts et @ScorDesigner',	1488078109),
(17,	'Déployer la première version du projet #FrenchCoders',	'Tâches à accomplir en vue de finaliser une première version de production exploitable pour le site du projet #FrenchCoders',	1488392390),
(18,	'Plateforme de messagerie collaborative ',	'Tâches à accomplir en vue de déployer la messagerie collaborative pour suivre et discuter les tâches de développement de #FrenchCoders et autres projets',	1488392456);

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-03-03 05:36:00
