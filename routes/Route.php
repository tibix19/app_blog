<?php
// Ce fichier définit la classe Route, qui gère le traitement des URL et l'exécution des actions associées dans l'application.

namespace Router;
use Database\DBConnection;

class Route
{
    public string $path; // Définit le chemin de la route
    public $action; // Définit l'action à exécuter lorsque la route est atteinte
    public $matches; // Stocke les correspondances d'URL capturé

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/'); // Nettoie le chemin en retirant les barres obliques au début et à la fin
        $this->action = $action; // Initialise l'action associée à la route
    }

    // Méthode pour vérifier si l'URL correspond au chemin de la route
    public function matches(string $url)
    {
        // Convertit le chemin de la route en une expression régulière pour les correspondances d'URL
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        // Vérifie si l'URL correspond au chemin de la route
        if (preg_match($pathToMatch, $url, $matches))
        {
            // Stocke les correspondances capturées dans $matches
            $this->matches = $matches;
            return true; // Retourne vrai si l'URL correspond au chemin de la route
        } else {
            return false; // Retourne faux si l'URL ne correspond pas au chemin de la route
        }
    }

    // Méthode pour exécuter l'action associée à la route
    public function execute()
    {
        // Divise l'action en un nom de contrôleur et une méthode
        $params = explode('@',$this->action);
        // Crée une nouvelle instance du contrôleur avec une connexion à la base de données
        $controller = new $params[0](new DBConnection());
        // Récupère le nom de la méthode à appeler sur le contrôleur
        $method = $params[1];
        // Appelle la méthode du contrôleur avec des paramètres s'ils existent dans les correspondances capturées
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}
