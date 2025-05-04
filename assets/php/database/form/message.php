<?php
class Message {
    private $db;
    
    public function __construct() {
        require_once dirname(__DIR__) . '../../../../assets/php/database/form/creation.php';
        $creation = new Creation();
        $this->db = $creation->getConnection(); 
        
        $this->createTableIfNotExists();
    }

    private function createTableIfNotExists() {
        $query = "CREATE TABLE IF NOT EXISTS messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            phone TEXT,
            message TEXT NOT NULL,
            created_at DATETIME NOT NULL
        )";
        
        $this->db->exec($query);
    }
    
    /**
     * Create a new message record
     * 
     * @param array $data Message data
     * @return bool Success status
     */
    public function create($data) {
        $query = "INSERT INTO messages (name, email, phone, message, created_at) 
                  VALUES (:name, :email, :phone, :message, :created_at)";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->bindParam(':created_at', $data['created_at']);
        
        return $stmt->execute();
    }
    
    /**
     * Get all messages
     * 
     * @return array Array of messages
     */
    public function getAll() {
        $query = "SELECT * FROM messages ORDER BY created_at DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get a message by ID
     * 
     * @param int $id Message ID
     * @return array|false Message data or false if not found
     */
    public function getById($id) {
        $query = "SELECT * FROM messages WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Delete a message by ID
     * 
     * @param int $id Message ID
     * @return bool Success status
     */
    public function delete($id) {
        $query = "DELETE FROM messages WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}
?>