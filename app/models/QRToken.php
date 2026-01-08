<?php
class QRToken {
    private $conn;
    private $table = 'qr_tokens';
    
    public $id;
    public $trip_id;
    public $token;
    public $expires_at;
    public $used_at;
    
    public function __construct($db) {
        $this->conn = $db;
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
    
    public function create($trip_id, $token) {
        $query = "INSERT INTO " . $this->table . " 
                  (trip_id, token, expires_at) 
                  VALUES (:trip_id, :token, DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':trip_id', $trip_id);
        $stmt->bindParam(':token', $token);
        
        return $stmt->execute();
    }
}
?>
