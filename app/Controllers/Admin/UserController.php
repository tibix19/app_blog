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
        return $this->view('admin.user.index', compact('users'));
    }
}