<?php
class Creation {
    private $db;

    public function __construct() {
        $dbPath = dirname(__DIR__) . '/form/portfolio.db'; 
        $dbDir = dirname($dbPath);

        if (!is_dir($dbDir)) {
            if (!mkdir($dbDir, 0755, true) && !is_dir($dbDir)) {
                throw new Exception("Failed to create directory: $dbDir");
            }
        }

        if (!is_writable($dbDir)) {
            throw new Exception("Directory is not writable: $dbDir");
        }

        try {
            $this->db = new PDO('sqlite:' . $dbPath);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec('PRAGMA foreign_keys = ON');
        } catch (PDOException $e) {
            throw new Exception('Database connection error: ' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->db;
    }
}
?>