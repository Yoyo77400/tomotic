# Suivis de l'avancement du projet TOMOTIC #

## MAJ du 08/08/23 ##

-Correction du bug sur les scripts JS bootstrap lié à un mauvais import de fichier.
-Configuration du RegistrationType afin de lui faire passer les valeurs attendues.
-Mise en forme du formulaire d'inscription proprement dans le template correspondant à la route register.
-Mise en forme du mail de confirmation lors de l'inscription.
-Ajustement de certains composant de la barre de Navigation.
-Mise en forme du formulaire de connexion.

## MAJ du 09/08/23 ##

-Mise en forme du DropDown avec lien en gras pour accéder aux catégories, avec sous celles ci leur sous-catégories associées en texte classique.
-Mise en place du carousel sur la page d'accueil.
-Création du formulaire de réinitialisation du mot de passe.
-Mise en forme du formulaire et du template de mail de réinitialisation.
-Mise en forme de la page d'une catégorie présentant une sous catégories avec des produits.
-Ajout d'un bouton d'accueil dans la nav bar.
-Mise en place d'un produit avec discount.
-Ajustement de la page de catégorie.
-Correction de bugs de rendu responsive
-Fixation du footer en bas de page pour les pages dont le contenue ne prend pas toute une page via ajustement des tailles min et max des éléments et du carousel pour la page d'accueil.

## Maj du 10/08/23 ##

-Création de la page des sous-catégories.
-Installation du bundle knp pagination.
-Ajout d'un système de pagination dans ces pages pour la gestions des sous-catégories contenant beaucoup de produits.
-Mise à jours du template de pagination dans le template de sliding.html.twig de knp paginator.
-Mise en place de la redirection vers le site dans la lft nav du dashboard.
-Ajout des images dans les détails des produits sur la partie administration.
-Ajout de la première image dans l'index de la page produit en dashboard.
-Mise en place des routes dynamiques avec slug pour les pages produits.
-Création d'un controller front pour nos utilisateurs.
-Création d'un template front pour nos utilisateurs. Reste à customiser le template.

## Maj du 12/08/23 ##

-Création de la page des produits avec mise en forme.
-Adaptation automatique du format du prix dans le code.
-Création du crud Utilisateur.
-Ajustements des templates admin de la gestion des utilisateurs.
-Formatage du formulaire UserType.
-Ajout de l'accès à la gestion des utilisateurs dans la left nav du dashboard

### A prévoir ###

-Réalisation de la page produit.
-Mise en place de la page toutes les catégories.
-Mise en place du fil d'ariane dans le site.
-Finition de la page d'accueil.
-Création de fixtures et des rôles utilisateurs.
-Sécurisation des données utilisateurs.
-Gestion des entités panier, articles, et commande pour la réalisation du tunnel d'achat.
-Création des entités liées aux solutions sur mesures.
-Documentation fullcalendar pour la mise en place des rendez-vous.
