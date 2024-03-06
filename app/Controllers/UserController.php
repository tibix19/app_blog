<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use App\Validation\Validator;

class UserController extends Controller
{

    public function editAccount()
    {
        $this->isConnected();
        $users = new User($this->getDB());
        // on recup les infos du user avec son id qui es dans une variable de session initier quand le user se connecte
        $user = $users->findById($_SESSION['idUser']);
        return $this->view('account.account', compact('user'));
    }

    public function updateAccount()
    {
        $this->isConnected();
        $user = new User($this->getDB());

        // Vérification des entrées utilisatrices
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:3']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /account');
            exit;
        }

        // recup l'id pour update
        $id = (int) $_SESSION['idUser'];
        // Hash du mot de passe avec le salt
        $salt = "i;151-120#";
        $hashedPassword = hash('sha256', $salt . $_POST['password']);
        $userData = [
            'username' => $_POST['username'],
            'password' => $hashedPassword
        ];

        // fait l'update dans le model avec les data
        $result = $user->update_model($id, $userData);

        if ($result){
            // revient sur la page
            return header('Location: /account');
        }
    }

    

    // affiche les posts que l'user a créés
    public function myPostsPanelIndex()
    {
        $this->isConnected();
        $userId = $_SESSION['idUser'];
        // recupe ces postes
        $myPosts = (new Post($this->getDB()))->myPosts();
        // retourner les users dans une views
        return $this->view('account.postIndex', compact('myPosts'));
    } 

    public function editPostUser($postId)
    {
        // Vérifier si l'utilisateur est connecté
        $this->isConnected();

        // Vérifier si l'ID du post est un entier
        if (!ctype_digit($postId)) {
            // Si ce n'est pas un entier, afficher une erreur 404
            $error = new NotFoundException();
            return $error->error404();
        }

        // Convertir l'ID du post en entier
        $postId = (int)$postId;

        // Vérifier si le post existe
        $post = (new Post($this->getDB()))->findById($postId);
        if (is_null($post)) {
            // Si le post n'existe pas, afficher une erreur 404
            $error = new NotFoundException();
            return $error->error404();
        }

        // Vérifier si l'utilisateur est l'auteur du post
        $isAuthor = (new Post($this->getDB()))->checkPostAuthor($postId);
        // check si le user qui a fait le post est égale à l'id de la personne qui est connecté
        if ($isAuthor->user_id == $_SESSION['idUser']) {
            // L'utilisateur connecté est l'auteur du post, permettre la modification
            $tags = (new Tag($this->getDB()))->all();
            return $this->view('account.formPostUser', compact('post', 'tags'));
        } else {
            // L'utilisateur connecté n'est pas l'auteur du post, afficher un message d'erreur
            $error = new NotFoundException();
            return $error->error403();
        }
    }

    public function updatePostUser(int $postId)
    {
        $this->isConnected();
        $post = new Post($this->getDB());

        $tags = array_pop($_POST);
        $result = $post->update_model($postId, $_POST, $tags);

        if ($result){
            // revient sur le panel admin après la modification
            return header('Location: /myposts');
        }
    }

    public function destroyPostUser(int $id)
    {
        $this->isConnected();
        $post = new Post($this->getDB());
        $result = $post->destroy_model($id);

        if ($result){
            // revient sur le panel admin après la supp
            return header('Location: /myposts');
        }
    }


}

