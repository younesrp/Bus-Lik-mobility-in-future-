<?php
require_once __DIR__ . '/../config/Db.php';

class QRToken {
    private $conn;
    private $table = 'qr_tokens';
    
    public $id;
    public $trip_id;
    public $token;
    public $expires_at;
    public $used_at;
    
    public function __construct($db = null) {
        $this->conn = $db ?: Db::connection();
    }
    
    public function getByToken($token) {
        $query = "SELECT * FROM " . $this->table . " WHERE token = :token LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function markAsUsed($id) {
        $query = "UPDATE " . $this->table . " SET used_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function create($trip_id, $token, $expires_at) {
        $query = "INSERT INTO " . $this->table . " (trip_id, token, expires_at) VALUES (:trip_id, :token, :expires_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':trip_id', $trip_id);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expires_at', $expires_at);
        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }
    
    public function validate($token) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE token = :token 
                  AND used_at IS NULL 
                  AND expires_at > NOW()";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            // Mark as used
            $update = "UPDATE " . $this->table . " 
                       SET used_at = NOW() 
                       WHERE id = :id";
            
            $stmt2 = $this->conn->prepare($update);
            $stmt2->bindParam(':id', $row['id']);
            
            if($stmt2->execute()) {
                return $row;
            }
        }
        return false;
    }
}
?>
