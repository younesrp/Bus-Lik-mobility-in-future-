<?php
require_once __DIR__ . '/../config/Db.php';

class Ligne {
    private $conn;
    private $table = 'lines';
    
    public $id;
    public $name;
    public $code;
    
    public function __construct($db = null) {
        $this->conn = $db ?: Db::connection();
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
    
    public function getLinesByStation($station_id) {
        $query = "SELECT l.* 
                  FROM " . $this->table . " l
                  JOIN line_stations ls ON l.id = ls.line_id
                  WHERE ls.station_id = :station_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':station_id', $station_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
