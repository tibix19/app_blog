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

    // funtion d'un bouton fait avec heredoc pour voir l'article en entier
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
            // insere dans table intermédiaire post_tag quels tags a ce post
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            // insere dans table intermédiaire user_post quel user a fait quel post
            $stmtUserPost = $this->db->getPDO()->prepare("INSERT INTO user_post (user_id, post_id) VALUES (?, ?)");
            // execution des requetes avec les données
            $stmtUserPost->execute([$_SESSION['idUser'], $id]);
            $stmt->execute([$id, $tagId]);
        }
        return true;
    }

    // function qui permet de recupérer les postes du user qui est connecté.
    public function myPosts()
    {
        // recuper les posts du user avec la variable de session idUser
        return $this->querySQL('SELECT * FROM posts p
                                INNER JOIN user_post up on up.post_id=p.id
                                WHERE up.user_id=?',[$_SESSION["idUser"]]) ;
    }


    public function checkPostAuthor(int $postId)
    {
        // Vérifier si l'association entre le post et l'utilisateur existe dans la table user_post
        return $this->querySQL("SELECT * FROM user_post WHERE post_id = ?", [$postId], true);
    }

}
