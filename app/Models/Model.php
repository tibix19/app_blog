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

    // requête qui permet de recup les élements d'une table par son id
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

    //
    public function  create_model(array $data, ?array $relations = null)
    {
        // Initialise des chaînes de caractères pour stocker les parties de la requête
        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;
        // Parcours les données à insérer
        foreach ($data as $key => $value)
        {
            // Vérifie si c'est le dernier élément du tableau
            $comma = $i == count($data) ? "" : ', ';
            // Construction de la liste des colonnes de la table
            $firstParenthesis .= "{$key}{$comma}";
            // Construction des paramètres à insérer dans la requête
            $secondParenthesis .= ":{$key}{$comma}";
            // Incrémente le compteur
            $i++;
        }
        // Exécute la requête SQL pour insérer les données dans la table
        return $this->querySQL("INSERT INTO {$this->table} ($firstParenthesis) 
                                    VALUES ($secondParenthesis)", $data);
    }

    // dans le tableau $data qu'on récupère avec $_POST on récupère tous les données
    public function update_model(int $id, array $data, ?array $relations = null)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value)
        {
            $comma = $i == count($data) ? "" : ', ';
            // Le point égal (.=) va rajouter ce qui il y a après l'égal à la variable. (concatenation !) https://openclassrooms.com/forum/sujet/que-signifie-un-point-avant-un-egal-en-php-53333
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }
        $data['id'] = $id;
        return $this->querySQL("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $data);
    }

    // appelle la fonction querySQL avec la requête SQL DELETE pour supprimer qqch
    public function destroy_model(int $id): bool
    {
        return $this->querySQL("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }


    // function qui prepare les requêtes sql et ne de pas récrire tout le code à chaque fois
    public function querySQL(string $sql, array $param = null, bool $single = null)
    {
        // Détermine la méthode PDO à utiliser en fonction de la présence de paramètres
        $method = is_null($param) ? 'query' : "prepare";
        // Vérifie si la requête est une instruction DELETE, UPDATE ou INSERT
        if (strpos($sql, 'DELETE') === 0 || strpos($sql, 'UPDATE') === 0 || strpos($sql, 'INSERT') === 0)
        {
            // Exécute la requête avec PDO
            $stmt = $this->db->getPDO()->$method($sql);
            // Définit le mode de récupération des données
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            // Exécute la requête avec les paramètres fournis
            return $stmt->execute($param);
        }
        // Détermine la méthode de récupération des données en fonction de la présence de $single
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';
        // Exécuter la requête
        $stmt = $this->db->getPDO()->$method($sql);
        // Définit le mode de récupération des données
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        // Vérifie si la méthode est 'query' ou 'prepare'
        if($method == 'query') {
            // Renvoie le résultat de la requête sous forme de tableau
            return $stmt->$fetch();
        } else {
            // Exécute la requête avec les paramètres fournis
            $stmt->execute($param);
            // Renvoie le résultat de la requête sous forme d'objet ou de tableau, selon $single
            return $stmt->$fetch();
        }
    }
}
