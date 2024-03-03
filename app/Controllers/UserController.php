<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use App\Validation\Validator;

class UserController extends Controller
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {
        // check si les entrées des user sont ok
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }
        // puis on regarde si le user est existant
        $users = new User($this->getDB());
        $user = $users->getByUsername($_POST['username']);

        if(password_verify($_POST['password'], $user->password)) {
            // $_SESSION['auth'] va etre egale à 1 ou 2 en fonction de si la personne est admin ou non
            $_SESSION['authAdmin'] = (int) $user->admin;
            $_SESSION['idUser'] = (int) $user->id;

            return header('Location: /account?success=true');
        } else{
            // message incorrect credentials
            $errorsCred = $validator->incorrectCredentials();
            $_SESSION['errors'][] = $errorsCred;
            return header('Location: /login?password=fasle');
        }
    }

    public function logout()
    {
        session_destroy();
        return header('Location: /');
    }

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
        // recup l'id pour update
        $id = (int) $_SESSION['idUser'];

        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userData = [
            'username' => $_POST['username'],
            'password' => $mdp
        ];

        // fait l'update dans le model avec les data
        $result = $user->update_model($id, $userData);

        if ($result){
            // revient sur la page
            return header('Location: /account');
        }
    }

    public function signup()
    {
        return $this->view('auth.signup');
    }

    public function signupPost()
    {
        // Vérification des entrées utilisateur
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:3']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /signup');
            exit;
        }
        // Vérification si le nom d'utilisateur existe déjà
        $user = new User($this->getDB());
        $existingUser = $user->getByUsername($_POST['username']);
        if ($existingUser) {
            $_SESSION['errors'][] = $validator->userAlreadyExist();
            header('Location: /signup');
            exit;
        }
        // Hash du mot de passe
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userData = [
            'username' => $_POST['username'],
            'password' => $hashedPassword
        ];
        // Envoie les données vers la base de données pour créer le compte
        $result = $user->create_model($userData);

        if ($result){
            // Connexion automatique après la création du compte
            $newUser = $user->getByUsername($_POST['username']);
            $_SESSION['authAdmin'] = (int) $newUser->admin;
            $_SESSION['idUser'] = (int) $newUser->id;

            // Rediriger l'utilisateur vers sa session
            return header('Location: /account?success=true');
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

