<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Exceptions\NotFoundException;

class BlogController extends Controller
{

    public function welcome()
    {
        return $this->view('blog.welcome');
    }

    // controller qui affiche tout les articles
    public function index()
    {
        // recup la con de la db
        $post = new Post($this->getDB());
        // recup tout les elements de la tables posts dans un array
        $posts = $post->all();
        return $this->view('blog.index', compact('posts'));
    }

    // controller qui affiche les posts seul
    public function show($id)
    {
        // Vérifie si $id est une chaîne de caractères représentant un entier
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
            return $this->view('blog.show', compact('post'));
        }
    }

    public function tag(int $id)
    {
        $tag = new Tag($this->getDB());
        $tag = $tag->findById($id);
        return $this->view('blog.tag', compact('tag'));
    }
}
