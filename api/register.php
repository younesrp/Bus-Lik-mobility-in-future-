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
$fullname = $data['name'] ?? $_POST['name'] ?? '';
$email = $data['email'] ?? $_POST['email'] ?? '';
$password = $data['password'] ?? $_POST['password'] ?? '';
$confirm_password = $data['confirm_password'] ?? $_POST['confirm_password'] ?? '';

if (empty($fullname) || empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Tous les champs sont requis']);
    exit;
}

if ($password !== $confirm_password) {
    echo json_encode(['status' => 'error', 'message' => 'Les mots de passe ne correspondent pas']);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(['status' => 'error', 'message' => 'Le mot de passe doit contenir au moins 6 caractères']);
    exit;
}

try {
    $db = Db::connection();
    $user = new User($db);
    
    // Vérifier si l'email existe déjà
    $user->email = $email;
    $existingUser = $user->getByEmail($email);
    
    if ($existingUser) {
        echo json_encode(['status' => 'error', 'message' => 'Cet email est déjà utilisé']);
        exit;
    }
    
    // Créer l'utilisateur
    $user->fullname = $fullname;
    $user->email = $email;
    $user->password = $password;
    $user->role = 'user';
    
    if ($user->register()) {
        // Get the created user
        $createdUser = $user->getByEmail($email);
        if ($createdUser) {
            // Create wallet for new user
            $walletQuery = "INSERT INTO wallets (user_id, balance) VALUES (:user_id, 0.00) ON DUPLICATE KEY UPDATE user_id = user_id";
            $walletStmt = $db->prepare($walletQuery);
            $walletStmt->bindParam(':user_id', $createdUser['id']);
            $walletStmt->execute();
            
            // Connecter automatiquement l'utilisateur
            $user->email = $email;
            $user->password = $password;
            if ($user->login()) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->fullname;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_role'] = $user->role;
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Inscription réussie',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->fullname,
                    'email' => $user->email
                ]
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'inscription']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'inscription']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur: ' . $e->getMessage()]);
}
?>
