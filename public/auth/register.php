<?php
// Handler pour register depuis public/
session_start();
require_once '../../config/Db.php';
require_once '../../app/models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        header("Location: ../register.php?error=" . urlencode("Tous les champs sont requis"));
        exit;
    }

    if ($password !== $confirm_password) {
        header("Location: ../register.php?error=" . urlencode("Les mots de passe ne correspondent pas"));
        exit;
    }

    if (strlen($password) < 6) {
        header("Location: ../register.php?error=" . urlencode("Le mot de passe doit contenir au moins 6 caractères"));
        exit;
    }

    try {
        $userModel = new User();
        
        if ($userModel->getByEmail($email)) {
            header("Location: ../register.php?error=" . urlencode("Cet email est déjà utilisé"));
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        if ($userModel->create($name, $email, $hashedPassword)) {
            $user = $userModel->getByEmail($email);
            if ($user) {
                // Ensure wallet exists
                $db = Db::connection();
                $walletQuery = "INSERT INTO wallets (user_id, balance) VALUES (:user_id, 0.00) ON DUPLICATE KEY UPDATE user_id = user_id";
                $walletStmt = $db->prepare($walletQuery);
                $walletStmt->bindParam(':user_id', $user['id']);
                $walletStmt->execute();
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                header("Location: ../dashboard.php?success=" . urlencode("Inscription réussie"));
                exit;
            }
        }
        
        header("Location: ../register.php?error=" . urlencode("Erreur lors de l'inscription"));
        exit;
    } catch (Exception $e) {
        header("Location: ../register.php?error=" . urlencode("Erreur: " . $e->getMessage()));
        exit;
    }
} else {
    header("Location: ../register.php");
    exit;
}
?>
