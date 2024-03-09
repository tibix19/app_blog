<?php

namespace App\Controllers\Admin;

use App\Exceptions\NotFoundException;
use App\Controllers\Controller;
use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller
{
    public function index()
    {
        $this->isAdmin();
        // con à la db + recup tous les users avec la function all()
        $users = (new User($this->getDB()))->all();
        // retourner les users dans une views
        $this->view('admin.account.index', compact('users'));
    }


    public function create()
    {
        $this->isAdmin();
        $this->view('admin.account.formUser');
    }

    public function createUser()
    {
        $this->isAdmin();
        // Vérification des entrées utilisatrices
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:3']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /admin/account/create');
            exit;
        }    

        // Vérification si le nom d'utilisateur existe déjà
        $user = new User($this->getDB());
        $existingUser = $user->getByUsername($_POST['username']);
        if ($existingUser) {
            $_SESSION['errors'][] = $validator->userAlreadyExist();
            header('Location: /admin/account/create');
            exit;
        }
        // hash du mot de passe avec le salt
        $salt = "i;151-120#";
        $hashedPassword = hash('sha256', $salt . $_POST['password']);
        $userData = [
            'username' => $_POST['username'],
            'password' => $hashedPassword,
            'admin' => $_POST['admin']
        ];
        // envoie des données dans vers la db
        $result = $user->create_model($userData);
        if ($result){
            header('Location: /admin/account?create=success');
        }
    }

    public function changeLevelUser(int $id)
    {
        $this->isAdmin();
        // Vérifiez si le niveau de l'utilisateur est défini dans la requête POST
        if (isset($_POST['admin'])) {
            // Créez un tableau de données à mettre à jour
            $data = [
                'admin' => $_POST['admin']
            ];
            // Mettre à jour le niveau de l'utilisateur dans la db
            $user = new User($this->getDB());
            $result = $user->update_model($id, $data);

            if ($result) {
                // Redirigez vers le panneau admin après la mise à jour
                header('Location: /admin/account?updatelevel=' . $id . '?' . $_POST['admin']);
                exit();
            }
        }
    }


    public function deleteUser(int $id)
    {
        $this->isAdmin();
        $user = new User($this->getDB());
        $result = $user->destroy_model($id);

        if ($result){
            // revient sur la page admin des comptes
            header('Location: /admin/account?delete=' . $id);
        }
    }


}