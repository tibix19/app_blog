<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;

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

    // controller qui affiche les posts seula
    public function show($id)
    {
        $post = new Post($this->getDB());
        $post = $post->findById($id);
        return $this->view('blog.show', compact('post'));
    }

    public function tag(int $id)
    {
        $tag = new Tag($this->getDB());
        $tag = $tag->findById($id);
        return $this->view('blog.tag', compact('tag'));
    }
}
