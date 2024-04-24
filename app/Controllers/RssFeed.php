<?php

namespace App\Controllers;

use App\Models\Post;

class RssFeed extends Controller
{

    // Envoie les données pour le flus rss à la vue
    public function rssFeed()
    {
        $post = new Post($this->getDB());
        // Récupérer la date du dernier article
        $latestPost = $post->dateLatestPost();
        // Récupérer les articles publiés
        $posts = $post->getPostPublished();
        // charger tout ça dans une vue
        include_once('../views/blog/rssFeed.php');
    }
}