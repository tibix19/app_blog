<?php
// Ce fichier définit le routeur de l'application, gère les routes GET et POST, et exécute les actions associées.

// Définition du namespace
namespace Router;

use App\Exceptions\NotFoundException;

class Router
{
    // Définition des attributs
    public $url;
    public $routes = [];

    // Constructeur de la classe Router
    public function __construct($url)
    {
        // Nettoie l'URL en enlevant les barres obliques inutiles au début et à la fin
        $this->url = trim($url, '/');
    }

    // Méthode pour définir une route GET
    public function get(string $path, string $action)
    {
        // Crée une nouvelle instance de la classe Route avec le chemin et l'action spécifiés
        $this->routes['GET'][] = new Route($path, $action);
    }

    // Méthode pour définir une route POST
    public function post(string $path, string $action)
    {
        // Crée une nouvelle instance de la classe Route avec le chemin et l'action spécifiés
        $this->routes['POST'][] = new Route($path, $action);
    }

    // Méthode pour exécuter le routage
    public function run()
    {
        // Parcourt les routes enregistrées pour la méthode de requête actuelle (GET ou POST)
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            // Vérifie si l'URL actuelle matche avec l'une des routes créées
            if ($route->matches($this->url)) {
                // Exécute l'action associée à la route
                return $route->execute();
            }
        }
        // Si aucune correspondance n'est trouvée, lance une exception NotFound
        throw new NotFoundException("Page demandé est introuvable");
    }

}