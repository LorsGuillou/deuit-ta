<a href="https://codeclimate.com/github/LorsGuillou/deuit-ta/maintainability"><img src="https://api.codeclimate.com/v1/badges/39edc3f4d31b9b32e855/maintainability" /></a>

# projet-final formation Kercode

Ce site est codé sur une base PHP, selon une architecture MVC ainsi qu'une approche ORM de par la présence du fichier Manager.

Pour pouvoir faire fonctionner le site sur un serveur local, la marche à suivre est la suivante : 

-> Utiliser la version 7.4 de PHP ou (supérieure)

-> Récupérer tout les dossiers et fichier du dépôt deuit-ta

-> Créer une base de données en local et y importer le fichier dump.sql

-> Compléter le fichier .env.example pour l'adapter à votre base de données locale, et le renommer en .env

-> Installer composer et effectuer un composer install à l'emplacement du site dans un terminal de commande

-> Pour vous connecter en tant qu'administrateur : 
    -> Rendez-vous sur la page Connexion et rentrer comme adresse e-mail "admin@admin.fr" et comme mot de passe "admin"
    -> Ou bien créer un nouveau compte, et dans la base de données changer la valeur de la colonne role à 1, ce qui donnera à ce compte le statut d'admin

Le dossier Public contient les fichiers CSS et JS, ainsi que les images du blog.

Le dossier app contient les dossiers suivants : 
-> Views, dans lequel se situent les pages du site 
-> Models, dans lequel se situent le Manager.php qui fait office d'ORM ainsi que les modèles se basant sur les tables de la base de données
-> Controllers, dans lequel se situent le contrôleur parent ainsi que les contrôleurs rattachés aux vues (FrontController), à la partie administrative (AdminController) et à la partie utilisateur (UserController)

Le site Deuit 'ta ! est mon projet final effectué au cours de la formation Kercode au développement web. Certaines fonctionnalités y seront ajoutées dans le futur, notamment la partie Activités qui sera alimenté par les utilisateurs.

La partie administration permet de publier, d'éditer et de supprimer les articles qui figureront dans la partie Blog du site, ainsi que de voir la liste des membres, de supprimer leurs comptes si besoin, ou de les contacter directement à l'adresse e-mail qu'ils ont fourni, et de lire les messages envoyés par les utilisateurs au travers du formulaire de la page Contact.

L'administrateur peut également supprimer n'importe quel commentaire. Les utilisateurs peuvent supprimer leurs propres commentaires s'ils sont connectés directement sur la page de l'article ou par l'espace compte.

Un diagramme UML est présent aux formats .drawio.xml et .png à la racine du projet.

Je vous remercie de l'attention que vous portez à mon projet !
N'hésitez à me faire parvenir vos retours !

Bien cordialement,

Laurent Guillou