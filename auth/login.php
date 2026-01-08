<?php
session_start();
require_once '../config/Db.php';
require_once '../app/models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: ../public/login.php?error=" . urlencode("Tous les champs sont requis"));
        exit;
    }

    try {
        $userModel = new User();
        $user = $userModel->getByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: ../public/dashboard.php?success=" . urlencode("Connexion réussie"));
            exit;
        } else {
            header("Location: ../public/login.php?error=" . urlencode("Email ou mot de passe incorrect"));
            exit;
        }
    } catch (Exception $e) {
        header("Location: ../public/login.php?error=" . urlencode("Erreur: " . $e->getMessage()));
        exit;
    }
} else {
    header("Location: ../public/login.php");
    exit;
}
?>
