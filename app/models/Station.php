<?php
class Station {
    private $conn;
    private $table = 'stations';
    
    public $id;
    public $name;
    public $latitude;
    public $longitude;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getStationsByLine($line_id) {
        $query = "SELECT s.*, ls.station_order 
                  FROM " . $this->table . " s
                  JOIN line_stations ls ON s.id = ls.station_id
                  WHERE ls.line_id = :line_id
                  ORDER BY ls.station_order";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':line_id', $line_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
