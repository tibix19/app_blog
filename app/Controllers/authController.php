<?php
// Controller pour l'authentification des utilisateurs (Création de compte et connexion)
namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Validation\Validator;
use LordDashMe\SimpleCaptcha\Captcha;

class  authController extends Controller {

    private string $codeCaptcha;

    // Controller pour afficher la page de connexion
    public function login()
    {
        $this->view('auth.login');
    }

    // controller pour la connexion des utilisateurs
    public function loginPost()
    {
        // check si les entrées des user sont ok
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        if($errors){ // si erreur, on les affiche
            $_SESSION['errors'][] = $errors;
            header('Location: /login');
            exit;
        }
        // puis, on regarde si le user est existant
        $users = new User($this->getDB());
        $user = $users->getByEmail(htmlspecialchars($_POST['email']));

        // Vérifier si un utilisateur a été trouvé
        if ($user) {
            // Hacher le mot de passe fourni par l'utilisateur en utilisant SHA-256 avec un sel
            $salt = "i;151-120#";
            $hashedPassword = hash('sha256', $salt . $_POST['password']);

            // Vérifier si le mot de passe haché correspond au hash stocké dans la base de données
            if (hash_equals($hashedPassword, $user->password)) {
                // Définir les informations d'authentification de session
                $_SESSION['authAdmin'] = (int)$user->admin;
                $_SESSION['idUser'] = (int)$user->id;
                header('Location: /account?success=true');
            } else {
                // Mauvaises informations d'identification, afficher message d'erreurs
                $errorsCred = $validator->incorrectCredentials();
                $_SESSION['errors'][] = $errorsCred;
                header('Location: /login?credentials=false');
            }
        } else {
            // Mauvaises informations d'identification, afficher message d'erreur
            $errorsCred = $validator->incorrectCredentials();
            $_SESSION['errors'][] = $errorsCred;
            header('Location: /login?credentials=false');
        }
    }

    // controller pour la déconnexion des utilisateurs
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

    // controller pour afficher la page de création de compte
    public function signup()
    {
        // Afficher le formulaire avec le captcha
        $this->view('auth.signup',);
    }

    // controller pour la création de compte
    public function signupPost()
    {
        // Vérification des entrées utilisatrices
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3']
        ]);
        if($errors){ // si il y a des erreurs, on les affiche
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
        $existingUser = $user->getByUsername(htmlspecialchars($_POST['username']));
        if ($existingUser) {
            $_SESSION['errors'][] = $validator->userAlreadyExist();
            header('Location: /signup');
            exit;
        }
        // Vérification si le mail existe déjà
        $user = new User($this->getDB());
        $existingEmail = $user->getByEmail(htmlspecialchars($_POST['email']));
        if ($existingEmail) {
            $_SESSION['errors'][] = $validator->emailAlreadyUse();
            header('Location: /signup');
            exit;
        }
        // Hash du mot de passe avec le salt
        $salt = "i;151-120#";
        $hashedPassword = hash('sha256', $salt . $_POST['password']);
        // récupération des données dans une variable + nettoie des caractères anormaux
        $userData = [
            'username' => htmlspecialchars($_POST['username']),
            'email' => htmlspecialchars($_POST['email']),
            'password' => $hashedPassword
        ];
        // Envoie les données vers la base de données si toutes les conditions en dessus sont remplis
        $result = $user->create_model($userData);

        if ($result){
            // Connexion automatique après la création du compte
            $newUser = $user->getByUsername($_POST['username']);
            // définition des variables de session
            $_SESSION['authAdmin'] = (int) $newUser->admin;
            $_SESSION['idUser'] = (int) $newUser->id;
            // Rediriger l'utilisateur vers la page de son profil
            header('Location: /account?success=true');
        }
    }


    // check si le code du captcha correspond à l'entrée du user
    // de type private par que cette méthode est utilisé que dans cette classe
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

