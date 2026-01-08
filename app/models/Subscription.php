<?php
class Subscription {
    private $conn;
    private $table = 'subscriptions';
    
    public $id;
    public $user_id;
    public $type;
    public $is_active;
    public $start_date;
    public $end_date;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function activate() {
        $query = "UPDATE " . $this->table . " 
                  SET is_active = 1, 
                      start_date = NOW(), 
                      end_date = DATE_ADD(NOW(), INTERVAL 30 DAY) 
                  WHERE id = :id AND user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);
        
        return $stmt->execute();
    }
    
    public function deactivate() {
        $query = "UPDATE " . $this->table . " 
                  SET is_active = 0 
                  WHERE id = :id AND user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);
        
        return $stmt->execute();
    }
    
    public function getUserSubscription($user_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE user_id = :user_id AND is_active = 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($user_id, $type = 'basic') {
        $query = "INSERT INTO " . $this->table . " 
                  (user_id, type, is_active) 
                  VALUES (:user_id, :type, 0)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':type', $type);
        
        return $stmt->execute();
    }
}
?>
