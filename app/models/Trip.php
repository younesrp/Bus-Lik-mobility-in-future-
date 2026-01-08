<?php
require_once 'QRCode.php';

class Trip {
    private $conn;
    private $table = 'trips';
    
    public $id;
    public $user_id;
    public $line_id;
    public $start_station_id;
    public $end_station_id;
    public $price;
    public $status;
    public $created_at;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function generateQR() {
        
        $qrToken = new QRToken($this->conn);
        $token = bin2hex(random_bytes(16));

        if($qrToken->create($this->id, $token)) {
            return $token;
        }
        return null;
    }
    
    public function create($user_id, $line_id, $start_station_id, $price) {
        $query = "INSERT INTO " . $this->table . " 
                  (user_id, line_id, start_station_id, price, status) 
                  VALUES (:user_id, :line_id, :start_station_id, :price, 'pending')";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':line_id', $line_id);
        $stmt->bindParam(':start_station_id', $start_station_id);
        $stmt->bindParam(':price', $price);
        
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    
    public function getUserTrips($user_id) {
        $query = "SELECT t.*, l.name as line_name, 
                         s1.name as start_station, s2.name as end_station
                  FROM " . $this->table . " t
                  LEFT JOIN lines l ON t.line_id = l.id
                  LEFT JOIN stations s1 ON t.start_station_id = s1.id
                  LEFT JOIN stations s2 ON t.end_station_id = s2.id
                  WHERE t.user_id = :user_id
                  ORDER BY t.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function calculatePrice($hasSubscription) {
        return $hasSubscription ? 2.00 : 5.00;
    }
}
?>
