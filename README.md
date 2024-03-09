# App blog CMS en PHP POO MVC

- avoir composer installer
- clone the repo
- modifier les infos de connexion à la db (DBConnexion.php)
- importer le dump qui est dans le dossier database
- lance xampp ou autre dans le dossier public
- faire un `composer dump-autoload` dans le meme dossier que composer.json
- Puis se rendre sur localhost



**TO DO**
- [x] faire en sorte que le nom du user qui a fait le poste s'enregistre pour qu'il s'affiche
- [x] Chaque user peut créer, modifier et supprimer leurs propres postes
- [x] Captcha https://github.com/LordDashMe/php-simple-captcha
- [] flux RSS
- [x] changer hash password to sha256 + paper et salt
- [x] Afficher tout les postes d'un user
- [x] Faire en sorte que la modif des tags fonctionne
- [] les photos / paragraphe dans le texte, couleur et autre subtilité du texte dans le poste (framework nodejs pour faire ça)
- [x] les admins qui peuvent changer le level d'un user
- [] docker
- [] front-end uikit
- [x] Créer un authController et mettre les function de login et de signup dedans pour simplifier le UserController
- [] Mettre des messages à chaque fois qu'une modfi est effectué (Modification enregistrée)
- [x] Mettre des validations à chaque formulaire
- [] Ajouter les commentaires
- [] Faire une barre de recherche
- [] (Admin peut ajouter ou enlever des tags)
- [] Voir tous les postes d'un utilisateur
- [] (Mettre un bouton ou on peut save les postes qu'on a aimés)
