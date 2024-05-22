<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Exceptions\NotFoundException;

class BlogController extends Controller
{
    // controller qui affiche tous les articles
    public function index()
    {
        // Si un terme de recherche est présent dans l'URL
        if (isset($_GET['search'])) {
            // Récupérer le terme de recherche
            $searchTerm = $_GET['search'];
            // Récupérer les articles correspondants à la recherche
            $post = new Post($this->getDB());
            $posts = $post->searchPosts($searchTerm);
            // Vérifier s'il y a des articles trouvés
            if (empty($posts)) {
                // Afficher un message si aucun article n'est trouvé et aussi tous les posts
                $message = "Aucun poste trouvé pour le terme de recherche : '$searchTerm'";
                $post = new Post($this->getDB());
                $posts = $post->getPostPublished();
                $this->view('blog.index', compact('posts', 'message'));
                return;
            }
        } else {
            // Si aucun terme de recherche n'est présent, récupérer tous les articles
            $post = new Post($this->getDB());
            $posts = $post->getPostPublished();
        }
        // Passer les articles à la vue
        $this->view('blog.index', compact('posts'));
    }

    // controller qui affiche les posts seuls
    public function show($id)
    {
        // Vérifie si $id est bien un entier
        if (!ctype_digit($id)) {
            // Si ce n'est pas un entier, redirige vers la page d'erreur 404
            $error = new NotFoundException();
            return $error->error404();
        }
        // Convertit $id en entier
        $id = (int)$id;
        // on instancie notre model post avec l'id passé en paramètre
        $post = new Post($this->getDB());
        $post = $post->findById($id);

        if(is_null($post)){
            // si le post n'existe pas >> error 404
            $error = new NotFoundException();
            return $error->error404();
        } else {
            // regarder si le post est publié ou brouillions
            // si le post est en mode brouillions rentré dans la condition
            if($post->published === 0)
            {
                // check si le user est connecté
                if(isset($_SESSION['idUser']))
                {
                    // si le user est connecté, il faut regarder si le post créer est bien de celui du qui est connecté ou si c'est un admin, il peut voir de toute manière le poste
                    $isAuthor = (new Post($this->getDB()))->checkPostAuthor($id);
                    if($isAuthor->user_id == $_SESSION['idUser'] OR $_SESSION['authAdmin'] === 1)
                    {
                        // afficher le post
                        $this->view('blog.show', compact('post'));
                    }
                    else{
                        // si ce n'est pas celui qui est l'a créé
                        $error = new NotFoundException();
                        return $error->error404();
                    }
                }
                else{
                    // si le post est en mode brouillions et que le user n'est pas connecté afficher une erreur
                    $error = new NotFoundException();
                    return $error->error404();
                }
            }
            else {
                // si le poste est publié, on l'affiche même si le user n'est pas connecté
                $this->view('blog.show', compact('post'));
            }
        }
    }

    public function tag(int $id)
    {
        $tag = new Tag($this->getDB());
        $tag = $tag->findById($id);
        $this->view('blog.tag', compact('tag'));
    }
}
