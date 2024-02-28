<?php
namespace App\Controllers;
use Database\DBConnection;

abstract class Controller
{
    protected $db;

    public function __construct(DBConnection $db)
    {
        // si pas de session on la démarre
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $this->db = $db;
    }

    protected function view(string $path, array $params = null): void
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    protected function getDB()
    {
        return $this->db;
    }

    // permet de savoir si la personne est loguer en temps que user ou admin et de la redirige ou pas sur la page
    protected function isAdmin(): bool
    {
        if (isset($_SESSION['authAdmin']) && $_SESSION['authAdmin'] === 1) {
            return true;
        } else{
            header('Location: /login');
            return false;
        }
    }

    protected function isUser(): bool
    {
        if (isset($_SESSION['auth']) && $_SESSION['authAdmin'] === 2) {
            return true;
        } else{
            header('Location: /login');
            return false;
        }
    }


    protected function isConnected(): bool
    {
        // si c'est connecté on renvoie vrai sinon faux
        if (isset($_SESSION['authAdmin']) OR $_SESSION['authAdmin'] === 2 OR $_SESSION['authAdmin'] === 1) {
            return true;
        } else{
            header('Location: /login');
            return false;
        }
    }

}
