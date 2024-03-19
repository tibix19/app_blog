<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Validation\Validator;

class PostController extends Controller
{

    // affiche tous les postes
    public function index()
    {
        $this->isAdmin();
        // con à la db + recup tous les articles avec la function all()
        $posts = (new Post($this->getDB()))->all();
        // retourner les articles dans une views
        $this->view('admin.post.index', compact('posts'));
    }

    // Affiche le formulaire pour créer un post
    public function create()
    {
        $this->isConnected();
        $tags = (new Tag($this->getDB()))->all();
        $this->view('admin.post.form', compact('tags'));
    }

    // function qui traite les données en POST
    public function createPost()
    {
        $this->isConnected();
        $post = new Post($this->getDB());
    
        // Vérifier les données saisies et afficher une erreur si nécessaire
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required', 'min:4'],
            'content' => ['required' , 'min:10']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /create');
            exit;
        }
    
        // Vérifier si au moins un tag est sélectionné
        if(empty($_POST['tags'])) {
            $_SESSION['errors'][] = [['Veuillez sélectionner un tag']];
            header('Location: /create');
            exit;
        }
    
        // Vérifier si un fichier a été uploadé
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
                header('Location: /create');
                exit;
            }
            // Générer un nom unique pour le fichier pour ne pas avoir 2 fois le meme non de fichier (id + nom de l'article + extension) et aussi enlever les espaces et les apostrophes par exemple
            $filenameWithoutSpace = str_replace(' ', '-', $_POST['title']);
            $newFilenameWithoutSpecialChara = str_replace("'", '-', $filenameWithoutSpace);
            $newFilename = uniqid() . '_' . $newFilenameWithoutSpecialChara . '.' . $extension;
            // Déplacer le fichier téléchargé vers le répertoire de destination
            if (!move_uploaded_file($tempFilePath, "../public/static/images/{$newFilename}")) {
                $_SESSION['errors'][] = [['Erreur lors de l\'upload de l\'image']];
                header('Location: /create');
                exit;
            }
            // Ajouter le nom de l'image aux données du post
            $_POST['image'] = $newFilename;
        }
        // Récupérer les tags pour la table post_tag
        $tags = $_POST['tags'];
        // Supprimer les tags du $_POST parce qu'ils ne sont pas dans la table posts
        unset($_POST['tags']);
    
        // Créer le post dans la base de données
        $result = $post->create_model($_POST, $tags);
    
        if ($result){
            // Rediriger vers le panneau d'administration après la création
            header('Location: /myposts?create=success');
        }
    }


    // affiche la vue pour edit un post
    public function edit(int $id)
    {
        $this->isAdmin();
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();
        $this->view('admin.post.form', compact('post', 'tags'));
    }

    // Fait pratiquement la meme chose que pour la création
    public function update(int $id)
    {
        // check si on est connecté en admin
        $this->isAdmin();
        $post = new Post($this->getDB());

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required', 'min:4'],
            'content' => ['required' , 'min:10']
        ]);
        if($errors){
            $_SESSION['errors'][] = $errors;
            header('Location: /create');
            exit;
        }
        // si aucun tag est selection afficher une erreur
        if($_POST['tags'] == null) {
            $_SESSION['errors'][] = [['Veuillez insérer un tags']];
            header('Location: /create');
            exit;
        }
        else {
            $tags = array_pop($_POST);
            $result = $post->update_model($id, $_POST, $tags);

            if ($result){
                // revient sur le panel admin après la modification
                header('Location: /admin/posts?update=success?'. $id);
            }
        }
    }

    // controller pour supprimer un post
    public function destroy(int $id)
    {
        $this->isAdmin();
        $posts = new Post($this->getDB());

        // Récupérer le nom de l'image associée au post
        $post = $posts->findById($id);
        $imageName = $post->image; // Remplacez "image" par le nom de votre colonne d'image

        // Supprimer le post de la base de données
        $result = $post->destroy_model($id);

        if ($result){
            // Supprimer l'image du serveur si elle existe
            if ($imageName) {
                $imagePath = "../public/static/images/{$imageName}";
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Supprimer l'image du serveur
                }
            }
            // revient sur le panel admin après la supp
            header('Location: /admin/posts?delete=success?'.$id);
        }
    }

}