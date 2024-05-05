<?php
namespace App\Controllers;
use App\Exceptions\NotFoundException;
use Database\DBConnection;

abstract class Controller
{
    protected $db;

    public function __construct(DBConnection $db)
    {
        // si pas de session, on la démarre
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $this->db = $db;
    }

    /**
     * Affiche une vue en incluant son contenu dans une mise en page
     * @param string $path Le chemin de la vue à afficher
     * @param array|null $params Les paramètres à passer à la vue (pas obligatoire)
     */
    protected function view(string $path, array $params = null): void
    {
        // Démarre le tampon de sortie
        ob_start();
        // Remplace les points dans le chemin par le séparateur de répertoire
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        // Inclut le fichier qui va être affiché (la vue)
        require VIEWS . $path . '.php';
        // Récupère le contenu du tampon de sortie, le vide et le stocke dans une variable
        $content = ob_get_clean();
        // Inclut le fichier de mise en page qui enveloppera le contenu de la vue
        require VIEWS . 'layout.php';
    }

    // recup la connexion à la db
    protected function getDB()
    {
        return $this->db;
    }

    // check si la personne est connecté en tant qu'admin
    protected function isAdmin(): bool
    {
        if (isset($_SESSION['authAdmin']) && $_SESSION['authAdmin'] === 1) {
            return true;
        } else{
            header('Location: /login');
            return false;
        }
    }

    // check si la personne est connecté en tant qu'user ou admin
    protected function isConnected()
    {
        // si c'est connecté, on renvoie vrai sinon faux
        if (isset($_SESSION['authAdmin'])) {
            return true;
        } else{
            header('Location: /login');
            return false;
        }
    }

}
