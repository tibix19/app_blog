<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $this->isAdmin();
        // con à la db + recup tous les users avec la function all()
        $users = (new User($this->getDB()))->all();
        // retourner les users dans une views
        return $this->view('admin.account.index', compact('users'));
    }


    public function create()
    {
        $this->isAdmin();
        return $this->view('admin.account.formUser');
    }

    public function createUser()
    {
        $this->isAdmin();
        $user = new User($this->getDB());
        // hash du mot de passe
        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userData = [
            'username' => $_POST['username'],
            'password' => $mdp
        ];
        // envoie des données dans vers la db
        $result = $user->create_model($userData);

        if ($result){
            // revient sur la panel admin après la creation
            return header('Location: /admin/account');
        }
    }


    public function deleteUser(int $id)
    {
        $this->isAdmin();
        $user = new User($this->getDB());
        $result = $user->destroy_model($id);

        if ($result){
            // revient sur la page admin des comptes
            return header('Location: /admin/account');
        }
    }


}