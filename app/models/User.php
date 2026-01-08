<?php
require_once __DIR__ . '/../config/Db.php';

class User {
    private $conn;
    private $table = 'users';
    
    public $id;
    public $fullname;
    public $email;
    public $password;
    public $role;
    public $created_at;
    
    public function __construct($db = null) {
        $this->conn = $db ?: Db::connection();
    }
    
    public function getByEmail($email) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($fullname, $email, $password) {
        $query = "INSERT INTO " . $this->table . " (fullname, email, password, role) VALUES (:fullname, :email, :password, 'user')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            $userId = $this->conn->lastInsertId();
            // Create wallet for new user
            $walletQuery = "INSERT INTO wallets (user_id, balance) VALUES (:user_id, 0.00)";
            $walletStmt = $this->conn->prepare($walletQuery);
            $walletStmt->bindParam(':user_id', $userId);
            $walletStmt->execute();
            return true;
        }
        return false;
    }
    
    public function register() {
        $query = "INSERT INTO " . $this->table . " 
                  SET fullname = :fullname, 
                      email = :email, 
                      password = :password, 
                      role = :role";
        
        $stmt = $this->conn->prepare($query);
        
        
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->role = htmlspecialchars(strip_tags($this->role));
        
        
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
        

        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $this->role);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    public function login() {
        $query = "SELECT id, fullname, email, password, role, created_at 
                  FROM " . $this->table . " 
                  WHERE email = :email 
                  LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row && password_verify($this->password, $row['password'])) {
            $this->id = $row['id'];
            $this->fullname = $row['fullname'];
            $this->email = $row['email'];
            $this->role = $row['role'];
            $this->created_at = $row['created_at'];
            
            return true;
        }
        return false;
    }
    
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
