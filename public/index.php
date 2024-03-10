<?php

use App\Exceptions\NotFoundException;
use Router\Router;

//  autoloader pour que les class se chargent automatiquement
require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views'  . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

// récupérer l'url
$router = new Router($_GET['url']);

// ce qui est après le @ est la function
// affiche les articles
$router->get('/','App\Controllers\BlogController@index');
$router->get('/posts','App\Controllers\BlogController@index');
// affiche un article en particulier
$router->get('/posts/:id','App\Controllers\BlogController@show');
// affiche articles par tag
$router->get('/tags/:id','App\Controllers\BlogController@tag');

// AUTH
// login
$router->get('/login', 'App\Controllers\authController@login');
$router->post('/login', 'App\Controllers\authController@loginPost');
// destroy de la session
$router->get('/logout', 'App\Controllers\authController@logout');
// signup
$router->get('/signup', 'App\Controllers\authController@signup');
$router->post('/signup', 'App\Controllers\authController@signupPost');

// ACCOUNT
// modifier les credentials de son compte
$router->get('/account','App\Controllers\UserController@editAccount');
$router->post('/account','App\Controllers\UserController@updateAccount');


// POST DES USER
$router->get('/myposts', 'App\Controllers\UserController@myPostsPanelIndex');
// la route create pour que les user puisse faire le propre post, mais on garde les function de PostController dans le dossier Admin (pas ouf)
$router->get('/create', 'App\Controllers\Admin\PostController@create');
$router->post('/create', 'App\Controllers\Admin\PostController@createPost');
// modifier leurs propres postes et aussi les supprimer
$router->get('/post/edit/:id', 'App\Controllers\UserController@editPostUser');
$router->post('/post/edit/:id', 'App\Controllers\UserController@updatePostUser');
$router->post('/post/delete/:id', 'App\Controllers\UserController@destroyPostUser');

// ADMIN
// voir, supprimer et (modifier) les infos du user
$router->get('/admin/account','App\Controllers\Admin\UserController@index');
// create user admin
$router->get('/admin/account/create','App\Controllers\Admin\UserController@create');
$router->post('/admin/account/create','App\Controllers\Admin\UserController@createUser');
// delete user
$router->post('/admin/account/delete/:id','App\Controllers\Admin\UserController@deleteUser');
// modifier le level du user
$router->post('/admin/account/edit/:id','App\Controllers\Admin\UserController@changeLevelUser');

// route qui affiche les posts
$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');
// route pour create un post
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->post('/admin/posts/create', 'App\Controllers\Admin\PostController@createPost');

// route pour delete un post
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\PostController@destroy');
// routes pour editer les post, route qui permet de d'aller sur la page pour modif les posts
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@edit');
// route qui permet d'aller modifier dans la db les posts
$router->post('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@update');

// RSS FEED
$router->get('/rss.xml', 'App\Controllers\RssFeed@rssFeed');


// Si url n'existe pas redirige vers page d'erreur
try {
    $router->run();
}
catch (NotFoundException $e) {
    $e->error404();
}
