<?php
// Ce fichier définit les routes de l'application web et les associe à des contrôleurs et des actions spécifiques.
// Importation des classes nécessaires
use App\Exceptions\NotFoundException;
use Router\Router;

// Autoloader pour charger automatiquement les classes
require '../vendor/autoload.php';
// Définition des constantes pour les vues et les scripts
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views'  . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

// Récupération de l'URL
$router = new Router($_GET['url']);

// Création des routes et association aux méthodes des contrôleurs
// ce qui est après le @ est la function
// Routes pour afficher les articles
$router->get('/','App\Controllers\BlogController@index'); // Page d'accueil
$router->get('/posts','App\Controllers\BlogController@index'); // Liste des articles
$router->get('/posts/:id','App\Controllers\BlogController@show'); // Article spécifique
$router->get('/tags/:id','App\Controllers\BlogController@tag'); // Articles par tag

// Routes pour l'authentification (AUTH)
$router->get('/login', 'App\Controllers\authController@login'); // Formulaire de login
$router->post('/login', 'App\Controllers\authController@loginPost'); // Formulaire de login
$router->get('/logout', 'App\Controllers\authController@logout'); // Déconnexion
$router->get('/signup', 'App\Controllers\authController@signup'); // Formulaire d'inscription
$router->post('/signup', 'App\Controllers\authController@signupPost'); // Soumission de l'inscription

// Routes pour la gestion du compte utilisateur (ACCOUNT)
$router->get('/account','App\Controllers\UserController@editAccount');// Modifier compte
$router->post('/update-username','App\Controllers\UserController@updateUsername');// Mise à jour du nom d'utilisateur
$router->post('/update-email','App\Controllers\UserController@updateEmail');// Mise à jour de l'email
$router->post('/update-password','App\Controllers\UserController@updatePassword');// Mise à jour du mot de passe


// Routes pour la gestion des posts des utilisateurs
$router->get('/myposts', 'App\Controllers\UserController@myPostsPanelIndex');// Affichage des posts de l'utilisateur
$router->get('/create', 'App\Controllers\Admin\PostController@create');// Formulaire de création de post
$router->post('/create', 'App\Controllers\Admin\PostController@createPost');// Soumission de la création de post
$router->get('/post/edit/:id', 'App\Controllers\UserController@editPostUser');// Formulaire d'édition de post
$router->post('/post/edit/:id', 'App\Controllers\UserController@updatePostUser'); // Soumission de l'édition de post
$router->post('/post/delete/:id', 'App\Controllers\UserController@destroyPostUser'); // Suppression de post

// Route pour mettre à jour l'état d'un post
$router->post('/post/edit/state/:id', 'App\Controllers\UserController@changeStatePost');// Changement d'état de post

// Routes pour l'administration (ADMIN)
$router->get('/admin/account','App\Controllers\Admin\UserController@index');// Voir et gérer les utilisateurs
$router->get('/admin/account/create','App\Controllers\Admin\UserController@create');// Formulaire de création d'utilisateur
$router->post('/admin/account/create','App\Controllers\Admin\UserController@createUser');// Soumission de la création d'utilisateur
$router->post('/admin/account/delete/:id','App\Controllers\Admin\UserController@deleteUser');// Suppression d'utilisateur
$router->post('/admin/account/edit/:id','App\Controllers\Admin\UserController@editUserAdmin');// Modification du niveau d'utilisateur

// Routes pour la gestion des posts par l'admin
$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index'); // Affichage des posts
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');// Formulaire de création de post
$router->post('/admin/posts/create', 'App\Controllers\Admin\PostController@createPost');// Soumission de la création de post
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\PostController@destroy');// Suppression de post
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@edit'); // Formulaire d'édition de post
$router->post('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@update');// Soumission de l'édition de post

// Routes pour la gestion des tags par l'admin
$router->get('/admin/tags/', 'App\Controllers\Admin\TagController@viewAllTag');// Affichage des tags
$router->post('/admin/tag/update/:id', 'App\Controllers\Admin\TagController@updateNameTag');// Mise à jour du nom du tag
$router->post('/admin/tag/create', 'App\Controllers\Admin\TagController@createTag');// Création de tag
$router->post('/admin/tag/delete/:id', 'App\Controllers\Admin\TagController@destroyTag');// Suppression de tag

// RSS FEED
$router->get('/rss.xml', 'App\Controllers\RssFeed@rssFeed');// Affichage du flux RSS

// Si l'URL n'existe pas, rediriger vers la page d'erreur
try {
    $router->run();
}
catch (NotFoundException $e) {
    $e->error404();
}
