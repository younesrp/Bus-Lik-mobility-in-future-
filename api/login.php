<?php
header('Content-Type: application/json');
session_start();
require_once '../config/Db.php';
require_once '../app/models/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? $_POST['email'] ?? '';
$password = $data['password'] ?? $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Email et mot de passe requis']);
    exit;
}

try {
    $db = Db::connection();
    $user = new User($db);
    $user->email = $email;
    $user->password = $password;
    
    if ($user->login()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->fullname;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_role'] = $user->role;
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user->id,
                'name' => $user->fullname,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email ou mot de passe incorrect']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur: ' . $e->getMessage()]);
}
?>
