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

        // Check les données entrées et si elles sont conformes aux restrictions sinon affiche une erreur
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

        // Vérifier si un fichier a été uploadé
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Récupérer le nom temporaire du fichier
            $tmpName = $_FILES['image']['tmp_name'];

            // Définir le dossier de destination FAUT QUE JE CHANGE
            $uploadDir = 'C:\Users\tibix\SynologyDrive\Apprentissage\Apprentisage cours\Module EPSIC\3eme_annee\Module_151_120\dev\app_blog\public\static\images\\';

            // Générer un nom unique pour le fichier
            $imageName = $_FILES['image']['name'];

            // Déplacer le fichier téléchargé vers le dossier de destination
            if (move_uploaded_file($tmpName, $uploadDir . $imageName)) {
                // Ajouter le nom de l'image aux données du poste
                $_POST['image'] = $imageName;
            } else {
                // Gérer les erreurs d'upload
                switch ($_FILES['image']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $errorMessage = "La taille de l'image dépasse la limite autorisée par le serveur.";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $errorMessage = "La taille de l'image dépasse la limite autorisée par le formulaire.";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $errorMessage = "L'image n'a été que partiellement téléchargée.";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $errorMessage = "Aucun fichier n'a été téléchargé.";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $errorMessage = "Le dossier temporaire est manquant.";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $errorMessage = "Échec de l'écriture du fichier sur le disque.";
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $errorMessage = "Une extension PHP a arrêté l'upload de l'image.";
                        break;
                    default:
                           $errorMessage = "Erreur inconnue lors de l'upload de l'image.";
                        break;
                }
                //var_dump($_FILES['image']['error']); die();
                $_SESSION['errors'][] = [[$errorMessage]];
                header('Location: /create');
                exit;
            }

        }

        // check si au moins tag est sélectionné
        if($_POST['tags'] == null) {
            $_SESSION['errors'][] = [['Veuillez insérer un tags']];
            header('Location: /create');
            exit;
        }
        else {
            // recup des tags pour la table post_tag
            $tags = $_POST['tags'];
            // supprimer les tags du $_POST parce qu'ils ne sont pas dans la table posts
            unset($_POST['tags']);
            $result = $post->create_model($_POST, $tags);
            if ($result){
                // revient sur le panel admin après la creation
                header('Location: /myposts?create=success');
            }
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
        $post = new Post($this->getDB());

        // Récupérer le nom de l'image associée au post
        $post = $post->findById($id);
        $imageName = $post->image; // Remplacez "image" par le nom de votre colonne d'image

        // Supprimer le post de la base de données
        $result = $post->destroy_model($id);

        if ($result){
            // Supprimer l'image du serveur si elle existe
            if ($imageName) {
                $imagePath = "C:\Users\\tibix\SynologyDrive\Apprentissage\Apprentisage cours\Module EPSIC\\3eme_annee\Module_151_120\dev\app_blog\public\static\images\\{$imageName}";
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Supprimer l'image du serveur
                }
            }
            // revient sur le panel admin après la supp
            header('Location: /admin/posts?delete=success?'.$id);
        }
    }

}