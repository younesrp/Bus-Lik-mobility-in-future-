<?php
class Horaire {
    private $conn;
    private $table = 'horaires';
    
    public $id;
    public $line_id;
    public $station_id;
    public $time;
    public $day_type; // 'weekday', 'saturday', 'sunday'
    public $direction; // 'forward', 'backward'
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    /**
     * Récupérer les horaires d'une ligne à une station spécifique
     */
    public function getHorairesByLineStation($line_id, $station_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE line_id = :line_id 
                  AND station_id = :station_id
                  ORDER BY time, day_type";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':line_id', $line_id);
        $stmt->bindParam(':station_id', $station_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupérer tous les horaires d'une ligne
     */
    public function getHorairesByLine($line_id) {
        $query = "SELECT h.*, s.name as station_name, s.latitude, s.longitude
                  FROM " . $this->table . " h
                  JOIN stations s ON h.station_id = s.id
                  WHERE h.line_id = :line_id
                  ORDER BY h.station_order, h.time";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':line_id', $line_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupérer les horaires par station
     */
    public function getHorairesByStation($station_id) {
        $query = "SELECT h.*, l.name as line_name, l.code as line_code
                  FROM " . $this->table . " h
                  JOIN lines l ON h.line_id = l.id
                  WHERE h.station_id = :station_id
                  ORDER BY h.time, h.line_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':station_id', $station_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupérer les prochains passages à une station
     */
    public function getNextPassages($station_id, $current_time = null, $limit = 5) {
        if ($current_time === null) {
            $current_time = date('H:i:s');
        }
        
        $query = "SELECT h.*, l.name as line_name, l.code as line_code,
                         CASE 
                             WHEN h.time >= :current_time THEN h.time
                             ELSE ADDTIME(h.time, '24:00:00')
                         END as next_time
                  FROM " . $this->table . " h
                  JOIN lines l ON h.line_id = l.id
                  WHERE h.station_id = :station_id
                  AND (
                      (h.day_type = 'weekday' AND DAYOFWEEK(NOW()) BETWEEN 2 AND 6)
                      OR (h.day_type = 'saturday' AND DAYOFWEEK(NOW()) = 7)
                      OR (h.day_type = 'sunday' AND DAYOFWEEK(NOW()) = 1)
                  )
                  ORDER BY next_time
                  LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':station_id', $station_id);
        $stmt->bindParam(':current_time', $current_time);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Ajouter un nouvel horaire
     */
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  (line_id, station_id, time, day_type, direction, station_order) 
                  VALUES (:line_id, :station_id, :time, :day_type, :direction, :station_order)";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyer les données
        $this->line_id = htmlspecialchars(strip_tags($this->line_id));
        $this->station_id = htmlspecialchars(strip_tags($this->station_id));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->day_type = htmlspecialchars(strip_tags($this->day_type));
        $this->direction = htmlspecialchars(strip_tags($this->direction));
        $this->station_order = htmlspecialchars(strip_tags($this->station_order));
        
        // Liaison des paramètres
        $stmt->bindParam(':line_id', $this->line_id);
        $stmt->bindParam(':station_id', $this->station_id);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':day_type', $this->day_type);
        $stmt->bindParam(':direction', $this->direction);
        $stmt->bindParam(':station_order', $this->station_order);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    /**
     * Mettre à jour un horaire
     */
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET line_id = :line_id,
                      station_id = :station_id,
                      time = :time,
                      day_type = :day_type,
                      direction = :direction,
                      station_order = :station_order
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Nettoyer les données
        $this->line_id = htmlspecialchars(strip_tags($this->line_id));
        $this->station_id = htmlspecialchars(strip_tags($this->station_id));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->day_type = htmlspecialchars(strip_tags($this->day_type));
        $this->direction = htmlspecialchars(strip_tags($this->direction));
        $this->station_order = htmlspecialchars(strip_tags($this->station_order));
        
        // Liaison des paramètres
        $stmt->bindParam(':line_id', $this->line_id);
        $stmt->bindParam(':station_id', $this->station_id);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':day_type', $this->day_type);
        $stmt->bindParam(':direction', $this->direction);
        $stmt->bindParam(':station_order', $this->station_order);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    /**
     * Supprimer un horaire
     */
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    
    public function getAll() {
        $query = "SELECT h.*, l.name as line_name, l.code as line_code, 
                         s.name as station_name
                  FROM " . $this->table . " h
                  JOIN lines l ON h.line_id = l.id
                  JOIN stations s ON h.station_id = s.id
                  ORDER BY l.name, h.station_order, h.time";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function getHorairesByDayAndDirection($line_id, $day_type, $direction) {
        $query = "SELECT h.*, s.name as station_name
                  FROM " . $this->table . " h
                  JOIN stations s ON h.station_id = s.id
                  WHERE h.line_id = :line_id
                  AND h.day_type = :day_type
                  AND h.direction = :direction
                  ORDER BY h.station_order, h.time";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':line_id', $line_id);
        $stmt->bindParam(':day_type', $day_type);
        $stmt->bindParam(':direction', $direction);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function formatHorairesForDisplay($horaires) {
        $formatted = [];
        
        foreach ($horaires as $horaire) {
            $time = date('H:i', strtotime($horaire['time']));
            $day_type_fr = [
                'weekday' => 'Semaine',
                'saturday' => 'Samedi',
                'sunday' => 'Dimanche'
            ][$horaire['day_type']];
            
            $direction_fr = [
                'forward' => 'Aller',
                'backward' => 'Retour'
            ][$horaire['direction']];
            
            $formatted[] = [
                'time' => $time,
                'day_type' => $day_type_fr,
                'direction' => $direction_fr,
                'line_name' => $horaire['line_name'] ?? '',
                'station_name' => $horaire['station_name'] ?? ''
            ];
        }
        
        return $formatted;
    }
}
?>
