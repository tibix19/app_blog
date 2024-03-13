<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use App\Validation\Validator;

class TagController extends Controller
{

    // afficher un tag
    public function viewAllTag()
    {
        $this->isAdmin();
        // con à la db + recup tous les articles avec la function all()
        $tags = (new Tag($this->getDB()))->all();
        // retourner les articles dans une views
        $this->view('admin.tag.indexTag', compact('tags'));
    }

    // supprimer un tag
    public function destroyTag(int $id)
    {
        $this->isAdmin();
        $post = new Tag($this->getDB());
        $result = $post->destroy_model($id);

        if ($result){
            // revient sur le panel admin après la supp
            header('Location: /admin/tags?delete=success?'.$id);
        }
    }


    // update le nom d'un tag
    public function updateNameTag(int $id)
    {
        $this->isAdmin();
        // Vérifiez si le niveau de l'utilisateur est défini dans la requête POST
        if (isset($_POST['tag'])) {
            // Créez un tableau de données à mettre à jour
            $data = [
                'name' => $_POST['tag']
            ];
            // Mettre à jour le niveau de l'utilisateur dans la db
            $user = new Tag($this->getDB());
            $result = $user->update_model($id, $data);

            if ($result) {
                // Redirigez vers le panneau admin après la mise à jour
                header('Location: /admin/tags?update=' . $id . '?' . $_POST['tag']);
                exit();
            }
        }
    }

    // Creation des tags
    public function createTag()
    {
        $this->isAdmin();
        // Vérification des entrées utilisatrices
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'name' => ['required', 'min:3']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /admin/tags');
            exit;
        }
        // envoie des données dans vers la db
        $tag = new Tag($this->getDB());
        $result = $tag->create_model($_POST);
        if ($result){
            header('Location: /admin/tags?create=success');
        }
    }


}