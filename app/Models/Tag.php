<?php

namespace App\Models;

use DateTime;

class Tag extends Model
{

    protected $table = 'tags';

    public function getPosts()
    {
        return $this->querySQL("
            SELECT p.* FROM posts p
            INNER JOIN post_tag pt ON pt.post_id = p.id
            WHERE pt.tag_id = ?
            ", [$this->id]);
    }


    public function getCreatedAt(): string
    {
        //$date =  new DateTime($this->created_at);
        //return $date->format('d/m/y à H:i');
        return (new DateTime($this->created_at))->format('d/m/y à H:i');
    }

}
