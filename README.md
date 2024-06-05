# Blog CMS en PHP MVC - Module 120/151

### Requirement

- Docker

### Installation
- Clone le repository `git clone https://github.com/tibix19/app_blog.git`
- Aller dans le dossier racine du projet `cd app_blog`
- Faire un `docker-compose up --build -d` pour créer le conteneur de l'application
- Se rendre sur phpmyadmin http://localhost:8080 pour vérifier que la db blog_db se soit importé correctement (mdp et login : `arogeiro`)
- Puis se rendre sur http://localhost/ 


### Credentials
- Le mot de passe et login pour se connecter à la DB c'est : `arogeiro` et `arogeiro`.
- Un compte administrateur, avec le mail : `angelo.rogeiro@eduvaud.ch` et le mdp : `arogeiro`, est créé automatiquement.


### TO DO
- [x] faire en sorte que le nom du user qui a fait le poste s'enregistre pour qu'il s'affiche
- [x] Chaque user peut créer, modifier et supprimer leurs propres postes
- [x] Captcha https://github.com/LordDashMe/php-simple-captcha
- [x] flux RSS
- [x] changer hash password to sha256 + paper et salt
- [x] Afficher tout les postes d'un user
- [x] Faire en sorte que la modif des tags fonctionne
- [x] les photos / paragraphe dans le texte, couleur et autre subtilité du texte dans le poste
- [x] les admins qui peuvent changer le level d'un user
- [x] docker
- [x] front-end uikit
- [x] Créer un authController et mettre les function de login et de signup dedans pour simplifier le UserController
- [x] Mettre des messages à chaque fois qu'une modification est effectuée (Modification enregistrée)
- [x] Mettre des validations à chaque formulaire
- [x] Faire une barre de recherche
- [x] (Admin peut ajouter ou enlever des tags)
- [x] Faire en sorte que les postes aient 2 états (brouillon et en ligne)
- [x] Récupération de l'adresse IP des utilisateurs connectés et modification à chaque nouvelle connexion
- [x] Fonctionnalité pour que les admins puissent activer ou bloquer un compte utilisateur 
- [x] Compresser les images
