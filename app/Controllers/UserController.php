<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {
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
        $users = new User($this->getDB());
        $user = $users->getByUsername($_POST['username']);

        if(password_verify($_POST['password'], $user->password)) {
            // $_SESSION['auth'] va etre egale à 1 ou 2 en fonction de si la personne est admin ou non
            $_SESSION['authAdmin'] = (int) $user->admin;
            $_SESSION['idUser'] = (int) $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['pass'] = $user->password;
            return header('Location: /account?success=true');
        } else{
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
        #$this->isAdmin();
        $user = (new User($this->getDB()));
        return $this->view('auth.account', compact('user'));
    }



}