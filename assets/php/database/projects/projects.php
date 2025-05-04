<?php

require_once 'Database.php';

class Project extends Database
{
    public function __construct()
    {
        parent::__construct();

        $this->db->exec('CREATE TABLE IF NOT EXISTS projects (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(100) NOT NULL,
            creation_date DATE NOT NULL,
            description TEXT NOT NULL,
            photo VARCHAR(100) NOT NULL
        )');
    }

    public function save(string $name, string $creation_date, string $description, string $photo): void
    {
        $statement = $this->db->prepare("INSERT INTO projects ('name', 'creation_date', 'description', 'photo') VALUES (:name, :creation_date, :description, :photo)");

        $statement->bindValue(':name', $name);
        $statement->bindValue(':creation_date', $creation_date);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':photo', $photo);

        $statement->execute();
    }

    public function getAll()
    {
        return $this->db->query('SELECT * FROM projects ORDER BY creation_date DESC')->fetchAll();
    }

    public function getPaginated($offset = 0, $limit = 6)
    {
        $statement = $this->db->prepare('SELECT * FROM projects ORDER BY creation_date DESC LIMIT :limit OFFSET :offset');
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetchAll();
    }

    public function get(string $id)
    {
        $stmt = $this->db->prepare('SELECT * FROM projects WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) as total FROM projects')->fetch()['total'];
    }
}