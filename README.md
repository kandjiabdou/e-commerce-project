# e-commerce-project
# Projet Programmation Web

Info1 Sup Galilée - semestre 2 - 2021/2022

Ce projet est un site e-commerce fait dans le cadre académique.


## Membre du groupe:
	- Abdou KANDJI
	- Abdoulaye BARRY
	- Mouhamed GUEYE
	- Alassane BA
	- Mouhamed Moustaphpa Seck



## Utilisation

Le projet est accompagné d'un fichier SQL 'e-commerce-project.sql' qui contient une instance de la base de donnée du site.
Le modèle conseptuelle de donnée est aussi donné sous format PNG 'shemabdd.png'

Deux utilisateur de teste sont créés dans la base de donnée :
- un client :
	- identifiant : user@test.fr
	- mdp : 1234
- un administrateur:
	- identifiant : admin@test.fr
	- mdp : 123

Afin de l'adapter à votre environnement, changer la configuration de la base de donnée dans le fichier:
	-src/common/DatabaseClient.php
Ce projet a été réalisé avec le logiciel Wamp avec MySQL.


## Fonctionnalité
Toutes les fonctionnalité demandées y sont présentes
1. Sans avoir à se connecter, l’utilisateur pourra / verra:
	a. afficher la liste de tous les articles
	b. ordonner cette liste par nom de l’article
	c. filtrer par catégorie de l’article ou par tranche de prix
	d. la liste paginée: on ne pourra pas voir plus de 10 articles par page
	e. s’il choisit de filtrer et/ou trier, le nouveau résultat revient à la page 1
	f. cacher ou montrer des filtres
	g. ajouter un article à son panier directement depuis la liste
	h. accéder à son panier
	i. supprimer un article de son panier
	j. s’inscrire au site
	k. Se connecter au site avec email + mot de passe
2. Une fois connecté, l’utilisateur pourra:
	a. se déconnecter
	b. Valider son panier
	c. Payer ses articles (un faux payement avec juste une fausse CB)
	d. Voir la liste de ses commandes
3. Une fois connecté en tant que compte administrateur
	a. Ajouter des articles au site
	b. se déconnecter
	c. Il n’aura pas accès au reste du site
	d. définir l’ordre d’affichage de la liste d’articles par défaut
D'autre fonctionnaalités sont présentes.



## Structure et Organisation des fichier:

Le projet est fait à l'aide du model MVC

├─── e-commerce-project.sql	: Instance de la base de donnée (données préremplies)
├─── README
└─── src
    │   index.php			: Routeur qui gère les pages
    │   Panier.php		: Fichier qui gère le panier (Requête ajax)
    │
    ├───common                : Contient le code commun à toutes les pages
    ├───controller		: Contient les fichiers controllers
    ├───model			: Contient les fichiers de la BDD (Requete SQL)
    ├───view			: Contient les fichiers de la Vue (des fonctions)
    └───assets			: Contient les ressources du site
        ├───css
        ├───image
        │   ├───camera
        │   ├───montre
        │   ├───ordinateur
        │   ├───silder
        │   └───telephone
        ├───js
        └───vendor