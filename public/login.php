<?php
$pageTitle = "Connexion";
// Définir le chemin de base pour les assets
define('BASE_PATH', '../');
require_once '../includes/header.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    
</head>
<body>
<div class="login-container">
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-header">
                <div class="logo-bus">
                    <img src="../assets/images/image1.png" alt="BusLik Logo">
                </div>
                <p>Connectez-vous à votre compte</p>
            </div>
                
            <form action="../api/login.php" method="POST" class="login-form" id="loginForm">
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
                    </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••" 
                            required
                            autocomplete="current-password"
                            class="form-input"
                        >
                        <button type="button" class="toggle-password" id="togglePassword">
                            <span class="eye-icon">👁️</span>
                        </button>
                    </div>
                </div>
                
                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="forgot.php" class="forgot-password">Mot de passe oublié ?</a>
                </div>
                
                <button type="submit" class="btn-login-submit">
                    Se connecter
                </button>
                
                <div class="register-link">
                    <p>Vous n'avez pas de compte ? <a href="register.php">Créer un compte</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
    <?php require_once '../includes/footer.php'; ?>
