<?php

namespace App\Models;

use DateTime;

class Tag extends Model
{

    protected $table = 'tags';

    // permet de savoir quel tag est associé avec quel poste, mais seulement sur les postes publiés
    public function getPosts()
    {
        return $this->querySQL("
            SELECT p.* FROM posts p
            INNER JOIN post_tag pt ON pt.post_id = p.id
            WHERE pt.tag_id = ? AND published = 1
            ", [$this->id]);
    }

    // met la date dans un autre format
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/y à H:i');
    }

}
