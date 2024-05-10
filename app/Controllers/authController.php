<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Validation\Validator;
use LordDashMe\SimpleCaptcha\Captcha;

class  authController extends Controller {

    private string $codeCaptcha;

    // login
    public function login()
    {
        $this->view('auth.login');
    }

    public function loginPost()
    {
        // check si les entrées des user sont ok
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }
        // puis, on regarde si le user est existant
        $users = new User($this->getDB());
        $user = $users->getByEmail($_POST['email']);

        // Vérifier si un utilisateur a été trouvé
        if ($user) {
            // Hacher le mot de passe fourni par l'utilisateur en utilisant SHA-256 avec un sel
            $salt = "i;151-120#";
            $hashedPassword = hash('sha256', $salt . $_POST['password']);

            // Vérifier si le mot de passe hashé correspond au hachage stocké dans la base de données
            if (hash_equals($hashedPassword, $user->password)) {
                // Définir les informations d'authentification de session
                $_SESSION['authAdmin'] = (int)$user->admin;
                $_SESSION['idUser'] = (int)$user->id;
                header('Location: /account?success=true');
            } else {
                // Mauvaises informations d'identification
                $errorsCred = $validator->incorrectCredentials();
                $_SESSION['errors'][] = $errorsCred;
                header('Location: /login?credentials=false');
            }
        } else {
            // Mauvaises informations d'identification
            $errorsCred = $validator->incorrectCredentials();
            $_SESSION['errors'][] = $errorsCred;
            header('Location: /login?credentials=false');
        }
    }

    // logout
    public function logout()
    {
        session_unset();
        session_destroy();
        // retourne sur la page index en affichant les postes et en affichant un message
        $message = "Vous êtes déconnecté";
        $post = new Post($this->getDB());
        $posts = $post->getPostPublished();
        $this->view('blog.index', compact('posts','message'));
    }

    // sign up
    public function signup()
    {
        // Afficher le formulaire avec le captcha
        $this->view('auth.signup',);
    }

    public function signupPost()
    {
        // Vérification des entrées utilisatrices
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /signup');
            exit;
        }

        // si captcha est incorrect afficher un message d'erreur
        if($this->captcha() == false)
        {
            $_SESSION['errors'][] = [["Captcha erroné !!!"]];
            header('Location: /signup');
            exit();
        }
        // Vérification si le nom d'utilisateur existe déjà
        $user = new User($this->getDB());
        $existingUser = $user->getByUsername($_POST['username']);
        if ($existingUser) {
            $_SESSION['errors'][] = $validator->userAlreadyExist();
            header('Location: /signup');
            exit;
        }
        // Vérification si le mail existe déjà
        $user = new User($this->getDB());
        $existingEmail = $user->getByEmail($_POST['email']);
        if ($existingEmail) {
            $_SESSION['errors'][] = $validator->emailAlreadyUse();
            header('Location: /signup');
            exit;
        }
        // Hash du mot de passe avec le salt
        $salt = "i;151-120#";
        $hashedPassword = hash('sha256', $salt . $_POST['password']);
        $userData = [
            'username' => htmlspecialchars($_POST['username']),
            'email' => htmlspecialchars($_POST['email']),
            'password' => $hashedPassword
        ];
        // Envoie les données vers la base de données
        $result = $user->create_model($userData);

        if ($result){
            // Connexion automatique après la création du compte
            $newUser = $user->getByUsername($_POST['username']);
            $_SESSION['authAdmin'] = (int) $newUser->admin;
            $_SESSION['idUser'] = (int) $newUser->id;
            // Rediriger l'utilisateur vers sa session
            header('Location: /account?success=true');
        }
    }



    // check si le code du captcha correspond à l'entrée du user
    private function captcha(): bool
    {
        session_abort();
        $captcha = new Captcha();
        $data = $captcha->getSession();

        // vérifie si le code entré par le user est égale au code du captcha
        if ($_POST['captcha'] !== $data['code']) {
            session_start();
            return false;
        } else {
            session_start();
            return true;
        }
    }
}

