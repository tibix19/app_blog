<?php
// fichier avec des fonctions pour gérer les différentes exceptions

namespace App\Exceptions;

use Exception;
use Throwable;

// class des exceptions (404, 403, ...) qui est extends de la class Exception
class NotFoundException extends Exception
{

     // Constructeur de la classe
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
         // Appel du constructeur de la classe parente avec les arguments a fournir
        parent::__construct($message, $code, $previous);
    }

    // Méthode pour gérer l'erreur 404
    public function error404() : void
    {
        // Définition du code de réponse HTTP 404
        http_response_code(404);
        // Définition du contenu de la page d'erreur 404 dans la variable $content qui sera ensuite afficher dans la page layout.php
        $content = "<h1 class='uk-heading-small uk-padding uk-padding-remove-left uk-margin-large-top uk-text-center'>La page demandé est introuvable !!!</h1>";
         // Inclusion de la variable content dans la page layout.php
        require VIEWS . 'layout.php';
    }

    // Méthode pour gérer l'erreur 403
    public function error403() : void
    {
        http_response_code(403);
        // Définition du code de réponse HTTP 403 dans la variable $content qui sera ensuite afficher dans la page layout.php
        $content = "<h1 class='uk-heading-small uk-padding uk-padding-remove-left uk-margin-large-top uk-text-center'>Vous n'êtes pas autorisé à accéder à cette page !!!</h1>";
        // Inclusion de la variable content dans la page layout.php
        require VIEWS . 'layout.php';
    }
}