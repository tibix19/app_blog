<?php

namespace App\Models;

use DateTime;

class Post extends Model
{
    protected $table = 'posts';

    public function getCreatedAt(): string
    {
        //$date =  new DateTime($this->created_at);
        //return $date->format('d/m/y à H:i');
        return (new DateTime($this->created_at))->format('d/m/y à H:i');
    }

    public function getExcerpt(): string
    {
        return substr($this->content, 0, 200) . '...';
    }

    // funtion d'un bouton fait avec heredoc pour voir l'article en entien
    public function getButton() : string
    {
        return <<<HTML
        <a href="/posts/$this->id" class="btn btn-primary">Lire l'article</a>
HTML;
    }


    public function getTags()
    {
        return $this->querySQL("SELECT t.* FROM tags t
                                    INNER JOIN post_tag pt ON pt.tag_id = t.id
                                    WHERE pt.post_id = ?", [$this->id]);
    }

    public function getCreatorPost(): string
    {
        $user = $this->querySQL("SELECT username FROM users u
                                    INNER JOIN user_post up ON up.user_id = u.id
                                    WHERE up.post_id = ?", [$this->id]);
        // si c'est vide ça retourne rien sion ça retourne le username
        return !empty($user) ? $user[0]->username : '';
    }


    public function create_model(array $data, ?array $relations = null)
    {
        parent::create_model($data);
        // permet de recup l'id du post qu'on vient de créer
        $id = $this->db->getPDO()->lastINSERTid();

        foreach ($relations as $tagId){
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }
        return true;
    }
}
