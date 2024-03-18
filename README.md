# Le bureau du game

Le projet contient normalement les dossiers "fonts", "video" et "img" qui contient lui-même "avatar", "games" et "icons" mais inutile de les ajouter ici.

J'ai fais une vidéo qui présente brièvement le site: https://fromsmash.com/demo-lebureaudugame.

Au niveau de /controlroom, il y a un bug lorsque je valide le contenu, c'est à cause de la méthode que j'utilise un peu bancale.
Je pourrais corriger ça en gérant le click avec du js classique et générer un json pour mettre à jour la base de données.

Si le lien est mort, demandez-moi pour le recréer.

## Objectif :

Développer et concevoir un site web avec toutes les fonctionnalités permettant d’enregistrer, modifier, supprimer et rechercher des utilisateurs inscris ainsi que du contenu multimédia.

## Contexte :

Ce type de projet pourrait répondre à tout type de créateur de contenu vidéo et photo. Il a été pensé ici pour permettre à n’importe quel joueur de publier ses temps forts et de communiquer sur ceux-ci afin de rassembler une communauté de gens passionnés par cet art vidéo ludique.

## Fonctions :

L’accueil regroupera les dernières news, les catégories de jeux avec leurs pages dédiées ainsi qu’une sélection random de screenshots.

Le site se partagera en 3 grands axes :

Le profil qui permettra à l’utilisateur de :

*	voir sa page perso publique où il sera possible de voir tout son contenu uploadé.

*	voir ses statistiques, un récap de ses données utilisateurs.

*	obtenir un rang avec un système de titre et de succès qui augmentera selon les uploads et qui permettra d’augmenter la taille disponible du contenu perso.

Le contenu :

*	ajouter/modifier/supprimer du contenu

*	voir la liste d’attente de validation

Les paramètres du compte :

*	Changer l’avatar, le pseudo, le mot de passe.

*	Choisir ses préférences (couleur du thème, du survol à la souris)

*	Choisir ses options de notifications (mail lors de nouveaux uploads spécifiques)

Pour la modération : une interface sera présente pour filtrer les uploads, notamment le contenu explicite.

Les outils de développement sont VScode et Wamp

Technologies utilisées :

* HTML5

*	CSS3

*	JavaScript suivi de sa librairie jQuery.

*	PHP 8.0.26

*	MySQL 8.0.31

## Uploads Process

Ici j'essaie de synthétiser le processus d'upload "semi-auto", le système au coeur du site qui permettra de réellement le rendre dynamique

Voici un premier schéma, il est amené à évoluer, voire supprimé, tout dépends de la méthode finale que j'utiliserais

![schemaBdd](https://github.com/Vaulkryn/lebureaudugame/assets/110675744/a2abf026-a65e-453d-b9e8-10f792a3241d)
