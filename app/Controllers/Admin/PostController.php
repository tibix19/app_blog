<?php
// Controleur CRUD sur les postes Admin

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
        // Augmenter la limite de mémoire pour que les images volumineuses puissent être traitées
        ini_set('memory_limit', '256M');

        $post = new Post($this->getDB());
        // Vérifier les données saisies et afficher une erreur si nécessaire
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'title' => ['required', 'min:4'],
            'content' => ['required' , 'min:10']
        ]);
        if($errors){ // s'il y a des erreurs affichées un message en fonction de l'erreur
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
            // Générer un nom unique pour le fichier pour ne pas avoir 2 fois le meme non de fichier
            $newFilename = uniqid() . ".". $extension;
            // Compresser et déplacer le fichier téléchargé vers le répertoire de destination
            try {
                switch ($extension) {
                    case 'jpg':
                    case 'jpeg':
                        // Créer une image à partir du fichier JPEG
                        $image = imagecreatefromjpeg($tempFilePath);
                        // Compresser et sauvegarder l'image avec une qualité de 40% (0% est le pire)
                        imagejpeg($image, "../public/static/images/{$newFilename}", 40);
                        break;
                    case 'png':
                        // Créer une image à partir du fichier PNG
                        $image = imagecreatefrompng($tempFilePath);
                        // Compresser et sauvegarder l'image avec un niveau de compression de 7 (0-9, 9 compression total)
                        imagepng($image, "../public/static/images/{$newFilename}", 7);
                        break;
                    case 'gif':
                        $image = imagecreatefromgif($tempFilePath);
                        // Sauvegarder l'image sans compression (GIF n'a pas de compression configurable)
                        imagegif($image, "../public/static/images/{$newFilename}");
                        break;
                    default:
                        // Si l'extension n'est pas reconnue, enregistrer une erreur en session et rediriger l'utilisateur
                        $_SESSION['errors'][] = [['Erreur lors de la compression de l\'image']];
                        header('Location: /create');
                        exit;
                }
                imagedestroy($image);
            } catch (Exception $e) {
                $_SESSION['errors'][] = [['Erreur lors de l\'upload ou la compression de l\'image']];
                header('Location: /create');
                exit;
            }
            // Ajouter le nom de l'image aux données du $_POST
            $_POST['image'] = $newFilename;
        }
        // Récupérer les tags pour la table post_tag
        $tags = $_POST['tags'];
        // Supprimer les tags du $_POST parce qu'ils ne sont pas dans la table posts
        unset($_POST['tags']);
        // Envoie des données dans le modèle
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
        // Vérifier si au moins un tag est sélectionné
        if(empty($_POST['tags'])) {
            $_SESSION['errors'][] = [['Veuillez sélectionner un tag']];
            header('Location: /admin/posts/edit/' . $id);
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
                header('Location: /admin/posts/edit/' . $id);
                exit;
            }
            // Générer un nom unique pour le fichier en utilisant l'ID du post suivi du titre du post
            $newFilename = uniqid() . ".".  $extension;

            $post_id = $post->findById($id);
            // Supprimer l'ancienne image si elle existe
            if (isset($post_id->image)) {
                unlink("../public/static/images/{$post_id->image}");
            }

            // Déplacer le fichier téléchargé vers le répertoire de destination
            if (!move_uploaded_file($tempFilePath, "../public/static/images/{$newFilename}")) {
                $_SESSION['errors'][] = [['Erreur lors de l\'upload de l\'image']];
                header('Location: /admin/posts/edit/' . $id);
                exit;
            }
            // Mettre à jour le nom de l'image dans la base de données
            $_POST['image'] = $newFilename;
        }
        // Récupérer les tags pour la table post_tag
        $tags = $_POST['tags'];
        // Supprimer les tags du $_POST parce qu'ils ne sont pas dans la table posts
        unset($_POST['tags']);

        // Mettre à jour le post dans la base de données
        $result = $post->update_model($id, $_POST, $tags);

        if ($result){
            // Rediriger vers le panneau d'administration après la modification
            header('Location: /admin/posts?update=success&' . $id);
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