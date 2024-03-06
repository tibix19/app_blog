<?php

namespace App\Controllers;

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
            'username' => ['required', 'min:3'],
            'password' => ['required']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }
        // puis, on regarde si le user est existant
        $users = new User($this->getDB());
        $user = $users->getByUsername($_POST['username']);

        // Hasher le mot de passe fourni par l'utilisateur en utilisant SHA-256 avec un salt
        $salt = "i;151-120#";
        $hashedPassword = hash('sha256', $salt . $_POST['password']);
        //var_dump($hashedPassword); die();

        // Vérifier si le mot de passe hashé correspond au hachage stocké dans la base de données
        if(hash_equals($hashedPassword, $user->password)){
            // $_SESSION['auth'] va etre egale à 1 ou 0 en fonction de si la personne est admin ou non
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

    // logout
    public function logout()
    {
        session_destroy()
;        return header('Location: /');
    }

    // sign up
    public function signup()
    {
        // Afficher le formulaire avec le captcha
        return $this->view('auth.signup',);
    }


    public function signupPost()
    {
        // Vérification des entrées utilisatrices
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

        // si faux message d'erreur
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

        // Hash du mot de passe avec le salt
        $salt = "i;151-120#";
        $hashedPassword = hash('sha256', $salt . $_POST['password']);
        $userData = [
            'username' => $_POST['username'],
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
            return header('Location: /account?success=true');
        }
    }


    // check si le code du captcha correspond à l'entrée du user
    private function captcha(): bool
    {
        session_abort();
        $captcha = new Captcha();
        $data = $captcha->getSession();

        if ($_POST['captcha'] !== $data['code']) {
            session_start();
            return false;
        } else {
            session_start();
            return true;
        }
    }
}

