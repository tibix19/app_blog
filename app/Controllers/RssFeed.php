<?php

namespace App\Controllers;

use App\Models\Post;

class RssFeed extends Controller
{

    public function rssFeed()
    {
        $post = new Post($this->getDB());
        // Récupérer le dernier article
        $latestPost = $post->latestPost();

        //var_dump($latestPost); die();

        // Récupérer les autres articles
        $posts = $post->all();
        // charger tout ça dans une vue
        include_once('../views/blog/rssFeed.php');
    }
}