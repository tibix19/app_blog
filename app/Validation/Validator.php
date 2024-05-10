<?php
// fichier de validations de données pour les entrées des utilisateurs
namespace App\Validation;

// Déclaration de la classe Validator dans l'espace de noms App\Validation
class Validator
{
    // Déclaration de la classe Validator dans l'espace de noms App\Validation
    private array $data;
    private $error;

    // Constructeur de la classe, prend un tableau de données à valider (en générale c'est un $_POST)
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // Méthode pour valider les données en fonction des règles fournies
    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray) {
            if(array_key_exists($name, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule)  {
                        // Si le champ est requis
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        // Si le champ doit avoir une longueur minimale
                        case substr($rule, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rule);
                            break;
                        case 'email':
                            $this->validateEmail($name, $this->data[$name]);
                            break;
                        default:
                            // Autres règles si nécessaire
                    }
                }
            }
        }
        return $this->getErrors();
    }

    // Méthode pour vérifier si le champ est requis
    private function required(string $name, string $value)
    {
            // Supprimer les espaces blancs inutiles
            $value = trim($value);
            // Si le champ est vide, ajouter une erreur
            if(!isset($value) || is_null($value) || empty($value)) {
                $this->error[$name][] = "{$name} est requis.";
            }
    }

    // Méthode pour vérifier la longueur minimale d'un champ
    public function min(string $name, string $value, string $rule)
    {
        // Extraire la longueur minimale à partir de la règle
        preg_match_all('/(\d+)/', $rule, $matches);
        // var_dump((int) $matches[0][0]); die();
        $limit = (int) $matches[0][0];
        // Si la longueur du champ est inférieure à la limite, ajouter une erreur
        if (strlen($value) < $limit){
            $this->error[$name][] = "{$name} doit comprendre un minimum de {$limit} caractères.";
        }
    }


    private function validateEmail(string $name, string $value)
    {
        // Supprimer les espaces blancs inutiles
        $value = trim($value);
        // Vérifier si l'adresse e-mail est valide
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->error[$name][] = "L'adresse e-mail {$value} n'est pas valide.";
        }
    }


    // Méthode pour obtenir les erreurs de validation
    private function getErrors(): ?array
    {
        return $this->error;
    }

    // Méthode pour indiquer des identifiants incorrects lors de l'authentification
    public function IncorrectCredentials()
    {
        http_response_code(401);
        return [['incorrectCredentials' => 'L\' adresse mail ou le mot de passe est incorrect.']];
    }

    // Méthode pour indiquer que les modifications ont été enregistrées avec succès
    public function modificationSave()
    {
        return  ['modificationSave' => 'Les modifications ont été enregistrées.'];
    }

    // Méthode pour indiquer qu'un utilisateur existe déjà
    public function userAlreadyExist()
    {
        return  $this->error = [['userAlreadyExist' => 'Le nom d\'utilisateur existe déjà']];
    }

    public function emailAlreadyUse()
    {
        return  $this->error = [['emailAlreadyUse' => 'Cette adresse e-mail est déjà utilisé']];
    }
}
