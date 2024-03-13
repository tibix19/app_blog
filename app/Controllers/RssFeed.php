<?php

namespace App\Controllers;

use App\Models\Post;

class RssFeed extends Controller
{

    // Envoie les données pour le flus rss à la vue
    public function rssFeed()
    {
        $post = new Post($this->getDB());
        // Récupérer le dernier article
        $latestPost = $post->latestPost();
        // Récupérer les autres articles
        $posts = $post->all();
        // charger tout ça dans une vue
        include_once('../views/blog/rssFeed.php');
    }
}