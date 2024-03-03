<?php

namespace App\Validation;

class Validator
{
    private array $data;
    private $error;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray) {
            if(array_key_exists($name, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule)  {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rule);
                        default:
                    }
                }
            }
        }
        return $this->getErrors();
    }

    private function required(string $name, string $value)
    {
            $value = trim($value);

            if(!isset($value) || is_null($value) || empty($value)) {
                $this->error[$name][] = "{$name} est requis.";
            }
    }

    public function min(string $name, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);

        // var_dump((int) $matches[0][0]); die();
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit){
            $this->error[$name][] = "{$name} doit comprendre un minimum de {$limit} caractères.";
        }
    }

    private function getErrors(): ?array
    {
        return $this->error;
    }

    public function IncorrectCredentials()
    {
        http_response_code(401);
        return [['incorrectCredentials' => 'Le nom d\'utilisateur ou le mot de passe est incorrect.']];
    }

    public function modificationSave()
    {
        return  ['modificationSave' => 'Les modifications ont été enregistrées.'];
    }

    public function userAlreadyExist()
    {
        return  $this->error = [['userAlreadyExist' => 'Le nom d\'utilisateur existe déjà']];
    }
}
