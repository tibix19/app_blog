<?php
// Controlleur CRUD sur les postes pour user standard

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use App\Validation\Validator;

class UserController extends Controller
{
    // controller pour afficher la vue pour edit un son propre user
    public function editAccount()
    {
        $this->isConnected();
        $users = new User($this->getDB());
        // on recup les infos du user avec son id qui es dans une variable de session initier quand le user se connecte
        $user = $users->findById($_SESSION['idUser']);
        $this->view('account.account', compact('user'));
    }

    // Modifier les données de notre user
    public function updateAccount()
    {
        $this->isConnected();
        $user = new User($this->getDB());

        // Vérification des entrées utilisatrices
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:3']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /account');
            exit;
        }

        // recup l'id pour update
        $id = (int) $_SESSION['idUser'];
        // Hash du mot de passe avec le salt
        $salt = "i;151-120#";
        $hashedPassword = hash('sha256', $salt . $_POST['password']);
        $userData = [
            'username' => $_POST['username'],
            'password' => $hashedPassword
        ];

        // fait l'update dans le model avec les data
        $result = $user->update_model($id, $userData);

        if ($result){
            // revient sur la page
            header('Location: /account');
        }
    }


    // affiche les posts que l'user a créés
    public function myPostsPanelIndex()
    {
        $this->isConnected();
        $userId = $_SESSION['idUser'];
        // recupe ces postes
        $myPosts = (new Post($this->getDB()))->myPosts();
        // retourner les users dans une views
        $this->view('account.postIndex', compact('myPosts'));
    } 

    // afficher la vue pour edit les postes et control qu'on peut seulement modifier les postes qu'ont à créer
    public function editPostUser($postId)
    {
        // Vérifier si l'utilisateur est connecté
        $this->isConnected();
        // Vérifier si l'ID du post est un entier
        if (!ctype_digit($postId)) {
            // Si ce n'est pas un entier, afficher une erreur 404
            $error = new NotFoundException();
            return $error->error404();
        }

        // Convertir l'ID du post en entier
        $postId = (int)$postId;

        // Vérifier si le post existe
        $post = (new Post($this->getDB()))->findById($postId);
        if (is_null($post)) {
            // Si le post n'existe pas, afficher une erreur 404
            $error = new NotFoundException();
            return $error->error404();
        }

        // Vérifier si l'utilisateur est l'auteur du post
        $isAuthor = (new Post($this->getDB()))->checkPostAuthor($postId);
        // check si le user qui a fait le post est égale à l'id de la personne qui est connecté
        if ($isAuthor->user_id == $_SESSION['idUser']) {
            // L'utilisateur connecté est l'auteur du post, permettre la modification
            $tags = (new Tag($this->getDB()))->all();
            $this->view('account.formPostUser', compact('post', 'tags'));
        } else {
            // L'utilisateur connecté n'est pas l'auteur du post, afficher un message d'erreur
            $error = new NotFoundException();
            return $error->error403();
        }
    }

    // envoie les données à la db pour la modification
    public function updatePostUser(int $postId)
    {
        $this->isConnected();
        $post = new Post($this->getDB());

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required', 'min:4'],
            'content' => ['required' , 'min:10']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /post/edit/' . $postId);
            exit;
        }
        // Vérifier si au moins un tag est sélectionné
        if(empty($_POST['tags'])) {
            $_SESSION['errors'][] = [['Veuillez insérer un tags']];
            header('Location: /post/edit/' . $postId);
            exit;
        }

        // Vérifier si un fichier a été uploadé ou erreur
        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Définir les extensions autorisées
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            // Récupérer les informations sur le fichier téléchargé
            $filename = $_FILES['image']['name'];
            $tempFilePath = $_FILES['image']['tmp_name'];
            // Obtenir l'extension du fichier
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            // Vérifier si l'extension est autorisée
            if (!in_array($extension, $allowedExtensions)) {
                $_SESSION['errors'][] = [['Extension de fichier non autorisée. Veuillez télécharger une image avec une extension JPG, JPEG, PNG ou GIF.']];
                header('Location: /post/edit/' . $postId);
                exit;
            }

            // supprimer l'ancien image s'il y en a une
            $postImage = $post->findById($postId);
            $imageName = $postImage->image;
            $imagePath = "../public/static/images/{$imageName}";

            if (file_exists($imagePath)) {
                unlink($imagePath); // Supprimer l'image du serveur
            }
            
            // Générer un nom unique
            $newFilename = uniqid() . '.' . $extension;
            // Déplacer le fichier téléchargé vers le répertoire de destination
            if (!move_uploaded_file($tempFilePath, "../public/static/images/{$newFilename}")) {
                $_SESSION['errors'][] = [['Erreur lors de l\'upload de l\'image']];
                header('Location: /post/edit/' . $postId);
                exit;
            }
            // Mettre à jour le nom de l'image dans la base de données
            $_POST['image'] = $newFilename;
        }


        $postImage = $post->findById($postId);
        $imageName = $postImage->image;
        $imageName = $_POST['image'];

        // Récupérer les tags pour la table post_tag
        $tags = $_POST['tags'];
        // Supprimer les tags du $_POST parce qu'ils ne sont pas dans la table posts
        unset($_POST['tags']);

        $result = $post->update_model($postId, $_POST, $tags);

        if ($result) {
            // revient sur le panel admin après la modification
            header('Location: /myposts?update=success?' . $postId);
        }
    }

    // supprimer un de nos postes
    public function destroyPostUser(int $id)
    {
        $this->isConnected();
        $post = new Post($this->getDB());

        // Récupérer le nom de l'image associée au post
        $post = $post->findById($id);
        $imageName = $post->image; // Remplacez "image" par le nom de votre colonne d'image
        $result = $post->destroy_model($id); // supprimer dans la db

        if ($result){
            // Supprimer l'image du serveur si elle existe
            if ($imageName) {
                $imagePath = "../public/static/images/{$imageName}";
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Supprimer l'image du serveur
                }
            }
            // revient sur le panel admin après la supp
            header('Location: /myposts?delete=success' . $id);
        }
    }
}

