<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Validation\Validator;

class PostController extends Controller
{

    // affiche tous les postes
    public function index()
    {
        $this->isAdmin();
        // con à la db + recup tous les articles avec la function all()
        $posts = (new Post($this->getDB()))->all();
        // retourner les articles dans une views
        $this->view('admin.post.index', compact('posts'));
    }

    // Affiche le formulaire pour créer un post
    public function create()
    {
        $this->isConnected();
        $tags = (new Tag($this->getDB()))->all();
        $this->view('admin.post.form', compact('tags'));
    }

    // function qui traite les données en POST
    public function createPost()
    {
        $this->isConnected();
        $post = new Post($this->getDB());

        // Check les données entrées et si elles sont conformes aux restrictions sinon affiche une erreur
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required', 'min:4'],
            'content' => ['required' , 'min:10']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /create');
            exit;
        }

        // check si au moins tag est sélectionné
        if($_POST['tags'] == null) {
            $_SESSION['errors'][] = [['Veuillez insérer un tags']];
            header('Location: /create');
            exit;
        }
        else {
            // array pop reprend les derniers elements du array de $_POST
            $tags = array_pop($_POST);
            $result = $post->create_model($_POST, $tags);
            if ($result){
                // revient sur le panel admin après la creation
                header('Location: /myposts?create=success');
            }
        }
    }

    // affiche la vue pour edit un post
    public function edit(int $id)
    {
        $this->isAdmin();
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        $this->view('admin.post.form', compact('post', 'tags'));
    }

    // Fait pratiquement la meme chose que pour la création
    public function update(int $id)
    {
        // check si on est connecté en admin
        $this->isAdmin();
        $post = new Post($this->getDB());

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required', 'min:4'],
            'content' => ['required' , 'min:10']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /create');
            exit;
        }
        // si aucun tag est selection afficher une erreur
        if($_POST['tags'] == null) {
            $_SESSION['errors'][] = [['Veuillez insérer un tags']];
            header('Location: /create');
            exit;
        }
        else {
            $tags = array_pop($_POST);
            $result = $post->update_model($id, $_POST, $tags);

            if ($result){
                // revient sur le panel admin après la modification
                header('Location: /admin/posts?update=success?'. $id);
            }
        }
    }

    // controller pour supprimer un post
    public function destroy(int $id)
    {
        $this->isAdmin();
        $post = new Post($this->getDB());
        $result = $post->destroy_model($id);

        if ($result){
            // revient sur le panel admin après la supp
            header('Location: /admin/posts?delete=success?'.$id);
        }
    }

}