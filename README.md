# App blog CMS en PHP POO MVC

- avoir composer installer
- clone the repo
- modifier les infos de connexion à la db (DBConnexion.php)
- importer le dump qui est dans le dossier database
- lance xampp ou autre dans le dossier public
- faire un `composer dump-autoload` dans le meme dossier où se trouve composer.json
- Puis se rendre sur localhost dans le navigateur
- Il faut peut-être aussi build le fichier json de nodejs pour uikit (il faut que je test)



**TO DO**
- [x] faire en sorte que le nom du user qui a fait le poste s'enregistre pour qu'il s'affiche
- [x] Chaque user peut créer, modifier et supprimer leurs propres postes
- [x] Captcha https://github.com/LordDashMe/php-simple-captcha
- [x] flux RSS
- [x] changer hash password to sha256 + paper et salt
- [x] Afficher tout les postes d'un user
- [x] Faire en sorte que la modif des tags fonctionne
- [] les photos / paragraphe dans le texte, couleur et autre subtilité du texte dans le poste (framework nodejs pour faire ça)
- [x] les admins qui peuvent changer le level d'un user
- [] docker
- [] front-end uikit
- [x] Créer un authController et mettre les function de login et de signup dedans pour simplifier le UserController
- [x] Mettre des messages à chaque fois qu'une modfi est effectué (Modification enregistrée)
- [x] Mettre des validations à chaque formulaire
- [] Ajouter les commentaires
- [x] Faire une barre de recherche
- [x] (Admin peut ajouter ou enlever des tags)
- [] Voir tous les postes d'un utilisateur
- [] Faire en sorte que les postes aient 2 états (brouillon et en ligne)


J'ai choisi l'utilisation des sessions au lieu des cookies parce que c'est plus simple et ça permet d'être en règle par rapport 
à la RGPD et pas besoin de demander d'autoriser les cookies