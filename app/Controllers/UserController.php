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

        try {
            $user = $users->getByUsername($_POST['username']);
        } catch(\Exception$e){
            return header('Location: /login?password=fasle');
        }

        if(password_verify($_POST['password'], $user->password)) {
            $_SESSION['auth'] = (int) $user->admin;
            return header('Location: /admin/posts?success=true');
        } else{
            return header('Location: /login?password=fasle');
        }
    }

    public function logout()
    {
        session_destroy();
        return header('Location: /');
    }

    public function editAccount(int $id)
    {
        $user = (new User($this->getDB()))->findById($id);
        return $this->view('account.account', compact('user'));
    }



}