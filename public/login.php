<?php
$pageTitle = "Connexion";
// Définir le chemin de base pour les assets
define('BASE_PATH', '../');
require_once '../includes/header.php';
?>
<style>
/* Styles inline pour garantir l'affichage */
body {
    background: linear-gradient(135deg, #4A6ED1 0%, #3A5AB8 100%) !important;
    min-height: 100vh !important;
    margin: 0 !important;
    padding: 0 !important;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.login-container {
    min-height: calc(100vh - 200px) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 2rem 1rem !important;
    position: relative !important;
    z-index: 1 !important;
}

.login-box {
    width: 100% !important;
    max-width: 450px !important;
    background: #FFFFFF !important;
    padding: 3rem 2.5rem !important;
    border-radius: 16px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2) !important;
    position: relative !important;
    z-index: 1 !important;
}

.login-header h1 {
    color: #4A6ED1 !important;
    font-size: 2rem !important;
    font-weight: 700 !important;
}

.logo-bus {
    font-size: 4rem !important;
    text-align: center !important;
    margin-bottom: 1rem !important;
}

.form-input {
    width: 100% !important;
    padding: 0.9rem 1rem !important;
    border: 2px solid #E2E8F0 !important;
    border-radius: 8px !important;
    font-size: 1rem !important;
    background: #FFFFFF !important;
    font-family: 'Poppins', sans-serif !important;
}

.form-input:focus {
    outline: none !important;
    border-color: #4A6ED1 !important;
    box-shadow: 0 0 0 3px rgba(74, 110, 209, 0.15) !important;
}

.btn-login-submit {
    width: 100% !important;
    padding: 1rem !important;
    background: #4A6ED1 !important;
    color: #FFFFFF !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 1rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    font-family: 'Poppins', sans-serif !important;
    margin-bottom: 1.5rem !important;
    box-shadow: 0 4px 15px rgba(74, 110, 209, 0.4) !important;
    transition: all 0.3s ease !important;
}

.btn-login-submit:hover {
    background: #3A5AB8 !important;
    box-shadow: 0 6px 20px rgba(74, 110, 209, 0.5) !important;
    transform: translateY(-2px) !important;
}

.forgot-password, .register-link a {
    color: #4A6ED1 !important;
    text-decoration: none !important;
}

.forgot-password:hover, .register-link a:hover {
    color: #3A5AB8 !important;
    text-decoration: underline !important;
}

.main-header {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px) !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
}
</style>

<div class="login-container">
    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-header">
                <div class="logo-bus">🚌</div>
                <h1>Bus-Lik</h1>
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
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
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

<?php require_once '../includes/footer.php'; ?>
