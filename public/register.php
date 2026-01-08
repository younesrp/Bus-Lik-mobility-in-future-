<?php
$pageTitle = "Inscription";
// Définir le chemin de base pour les assets
define('BASE_PATH', '../');
require_once '../includes/header.php';
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - BusLik</title>
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
                <p>Créez votre compte</p>
            </div>
                
            <form action="auth/register.php" method="POST" class="login-form" id="registerForm">
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
                    <label for="name">Nom complet</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="Votre nom complet" 
                        required
                        autocomplete="name"
                        class="form-input"
                    >
                </div>
                
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
                            autocomplete="new-password"
                            class="form-input"
                            minlength="6"
                        >
                        <button type="button" class="toggle-password" id="togglePassword">
                            <span class="eye-icon">👁️</span>
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="confirm_password" 
                            name="confirm_password" 
                            placeholder="••••••••" 
                            required
                            autocomplete="new-password"
                            class="form-input"
                            minlength="6"
                        >
                        <button type="button" class="toggle-password" id="toggleConfirmPassword">
                            <span class="eye-icon">👁️</span>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn-login-submit">
                    S'inscrire
                </button>
                
                <div class="register-link">
                    <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
document.getElementById('togglePassword')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
});

document.getElementById('toggleConfirmPassword')?.addEventListener('click', function() {
    const confirmPasswordInput = document.getElementById('confirm_password');
    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordInput.setAttribute('type', type);
});

// Password confirmation validation
document.getElementById('registerForm')?.addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas.');
        return false;
    }
});
</script>
<?php require_once '../includes/footer-auth.php'; ?>
