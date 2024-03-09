<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Validation\Validator;

class PostController extends Controller
{

    public function index()
    {
        $this->isAdmin();
        // con à la db + recup tous les articles avec la function all()
        $posts = (new Post($this->getDB()))->all();
        // retourner les articles dans une views
        return $this->view('admin.post.index', compact('posts'));
    }

    // retourne la bonne view
    public function create()
    {
        $this->isConnected();
        $tags = (new Tag($this->getDB()))->all();
        return $this->view('admin.post.form', compact('tags'));
    }

    // function qui traite les données en POST
    public function createPost()
    {
        $this->isConnected();
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

        // check si au moins tag est selectionné
        if($_POST['tags'] == null) {
            $_SESSION['errors'][] = [['Veuillez insérer un tags']];
            header('Location: /create');
            exit;
        }
        else {
            // array pop reprend les elements derniers du array de $_POST
            $tags = array_pop($_POST);
            $result = $post->create_model($_POST, $tags);
            if ($result){
                // revient sur le panel admin après la creation
                return header('Location: /posts');
            }
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        return $this->view('admin.post.form', compact('post', 'tags'));
    }

    public function update(int $id)
    {
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
                return header('Location: /admin/posts');
            }
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $post = new Post($this->getDB());
        $result = $post->destroy_model($id);

        if ($result){
            // revient sur le panel admin après la supp
            return header('Location: /admin/posts');
        }
    }

}