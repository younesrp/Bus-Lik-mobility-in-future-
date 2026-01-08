<?php
$pageTitle = "Mot de passe oublié";
// Définir le chemin de base pour les assets
define('BASE_PATH', '../');
require_once '../includes/header.php';
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - BusLik</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    
</head>
<body>
<div class="login-container">
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-header">
                <div class="logo-bus">
                    <img src="../assets/images/image1.png" alt="BusLik Logo" style="height: 120px; width: auto; max-width: 300px; display: block; margin: 0 auto;">
                </div>
                <p>Réinitialiser votre mot de passe</p>
            </div>
                
            <form action="../auth/forgot.php" method="POST" class="login-form" id="forgotForm">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-error">
                        <span>⚠️</span>
                        <span><?php echo htmlspecialchars($_GET['error']); ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <span>✅</span>
                        <span><?php echo htmlspecialchars($_GET['success']); ?></span>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="votre@email.com" 
                        required
                        autocomplete="email"
                        class="form-input"
                    >
                    <p style="font-size: 0.875rem; color: #718096; margin-top: 0.5rem;">
                        Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
                    </p>
                </div>
                
                <button type="submit" class="btn-login-submit">
                    Envoyer le lien de réinitialisation
                </button>
                
                <div class="register-link">
                    <p><a href="login.php">← Retour à la connexion</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once '../includes/footer-auth.php'; ?>
