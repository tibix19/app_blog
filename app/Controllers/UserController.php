<?php

namespace App\Controllers;

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
        return $this->view('auth.account', compact('user'));
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


    public function myPostsPanelIndex()
    {
        $this->isConnected();

        $myPosts = (new Post($this->getDB()))->myPosts();
        // retourner les users dans une views
        return $this->view('account.postIndex', compact('myPosts'));
    }

}