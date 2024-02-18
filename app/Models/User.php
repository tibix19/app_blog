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


    public function update_model(int $id, array $data, ?array $relations = null)
    {
        parent::update_model($id, $data);
        // delete les données
        $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([$id]);

        // remet les données
        foreach ($relations as $tagId){
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

        if($result){
            return true;
        }
    }
}
