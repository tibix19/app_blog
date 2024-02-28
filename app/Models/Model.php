<?php

namespace App\Models;

use Database\DBConnection;
use PDO;

// class qui fait un crud sur une table
abstract class Model
{
    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    // permet de recup tous les elements d'une table dynamiquement
    public function all(): array
    {
        return $this->querySQL("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    }

    // requete qiu permet de recup les elemnts d'un table par son id
    public function findById(int $id): ?Model
    {
        $result = $this->querySQL("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    
        // Vérifiez si $result est un objet de type Model
        if ($result instanceof Model) {
            return $result;
        } else {
            return null;
        }
    }


    public function  create_model(array $data, ?array $relations = null)
    {
        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach ($data as $key => $value)
        {
            $comma = $i == count($data) ? "" : ', ';
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }

        return $this->querySQL("INSERT INTO {$this->table} ($firstParenthesis) 
                                    VALUES ($secondParenthesis)", $data);
    }

    // dans le tableau $data qu'on récupere avec $_POST on recup tout les données
    public function update_model(int $id, array $data, ?array $relations = null)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value)
        {
            $comma = $i == count($data) ? "" : ', ';
            // le point egale va rajouter ce qui a après le égal à la variable. (concatenation !) https://openclassrooms.com/forum/sujet/que-signifie-un-point-avant-un-egal-en-php-53333
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }
        $data['id'] = $id;
        return $this->querySQL("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $data);
    }

    public function destroy_model(int $id): bool
    {
        return $this->querySQL("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }


    // function qui prepare les requete sql et ne de pas recrire tout le code à chaque fois
    public function querySQL(string $sql, array $param = null, bool $single = null)
    {
        $method = is_null($param) ? 'query' : "prepare";

        if (strpos($sql, 'DELETE') === 0 || strpos($sql, 'UPDATE') === 0 || strpos($sql, 'INSERT') === 0)
        {
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $stmt->execute($param);
        }
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if($method == 'query') {
            return $stmt->$fetch();
        } else {
            $stmt->execute($param);
            return $stmt->$fetch();
        }
    }
}
