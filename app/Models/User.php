<?php

namespace App\Models;

use DateTime;

class User extends Model
{
    protected $table = 'users';

    public function getByUsername(string $username)
    {
        return $this->querySQL("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
    }

    public function getCreatedAt(): string
    {
        //$date =  new DateTime($this->created_at);
        //return $date->format('d/m/y à H:i');
        return (new DateTime($this->created_at))->format('d/m/y à H:i');
    }




}
