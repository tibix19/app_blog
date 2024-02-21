<?php

use App\Exceptions\NotFoundException;
use Router\Router;

//  autoloader pour que les class ce charge automatiquement
require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views'  . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

// recup l url
$router = new Router($_GET['url']);

// ce qui est après le @ est la function
// affiche les articles
$router->get('/','App\Controllers\BlogController@index');
$router->get('/posts','App\Controllers\BlogController@index');
// affiche un article en particulier
$router->get('/posts/:id','App\Controllers\BlogController@show');
// affiche articles par tag
$router->get('/tags/:id','App\Controllers\BlogController@tag');

// route pour ce connecter
$router->get('/login', 'App\Controllers\UserController@login');
// route pour envoyer les données à la db
$router->post('/login', 'App\Controllers\UserController@loginPost');
// destroy de la session
$router->get('/logout', 'App\Controllers\UserController@logout');

// voir est modifier les infos du user
$router->get('/admin/account','App\Controllers\Admin\UserController@index');

// route qui affiche les posts
$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');
// route pour create un post
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->post('/admin/posts/create', 'App\Controllers\Admin\PostController@createPost');
// route pour delete un post
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\PostController@destroy');
// routes pour editer les post , route qui permet de d'aller sur la page pour modif les posts
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@edit');
// route qui permet d'aller modifier dans la db les posts
$router->post('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@update');

// Si l url n existe pas redirige vers page d erreur
try {
    $router->run();
}
catch (NotFoundException $e) {
    echo $e->error404();
}
