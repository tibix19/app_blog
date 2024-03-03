<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


    public function error404() : void
    {
        http_response_code(404);
        $content = "<h1>La page demandé est introuvable !</h1>";
        require VIEWS . 'layout.php';
    }

    public function error403() : void
    {
        http_response_code(403);
        $content = "<h1>Vous n'êtes pas autorisé à accéder à cette page.</h1>";
        require VIEWS . 'layout.php';
    }
}