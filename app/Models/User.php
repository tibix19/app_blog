<?php

namespace App\Models;

use DateTime;

class User extends Model
{
    // définir l'attribut $table au nom de la table dans la db
    protected $table = 'users';

    // recupération des infos du user s'il existe
    public function getByUsername(string $username)
    {
        return $this->querySQL("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
    }

    public function getByEmail(string $email)
    {
        return $this->querySQL("SELECT * FROM {$this->table} WHERE email = ?", [$email], true);
    }

    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/y à H:i');
    }

}
