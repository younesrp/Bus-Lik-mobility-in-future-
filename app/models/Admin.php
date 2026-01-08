<?php
class Admin extends User {
    
    public function __construct($db) {
        parent::__construct($db);
    }
    
    public function viewStats($period = 'daily') {
        $query = "";
        
        switch($period) {
            case 'daily':
                $query = "SELECT DATE(created_at) as date, 
                                 COUNT(*) as total_trips,
                                 SUM(price) as total_revenue
                          FROM trips 
                          WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                          GROUP BY DATE(created_at)
                          ORDER BY date DESC";
                break;
                
            case 'monthly':
                $query = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month,
                                 COUNT(*) as total_trips,
                                 SUM(price) as total_revenue
                          FROM trips 
                          GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                          ORDER BY month DESC";
                break;
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function manageLines($action, $data = null) {
        switch($action) {
            case 'add':
                $line = new Line($this->conn);
                $line->name = $data['name'];
                $line->code = $data['code'];
                
                $query = "INSERT INTO lines (name, code) VALUES (:name, :code)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $line->name);
                $stmt->bindParam(':code', $line->code);
                
                return $stmt->execute();
                
            case 'delete':
                $query = "DELETE FROM lines WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $data['id']);
                
                return $stmt->execute();
        }
    }
    
    public function getAllUsers() {
        $query = "SELECT u.*, w.balance, 
                         (SELECT COUNT(*) FROM trips WHERE user_id = u.id) as total_trips
                  FROM users u
                  LEFT JOIN wallets w ON u.id = w.user_id
                  ORDER BY u.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
