<?php
session_start();
require_once __DIR__ . '/functions.php';
$basePath = getBasePath();

// Déterminer le chemin du logo
$logoPath = getAssetPath('assets/images/image1.png');
if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
    $logoPath = '../assets/images/image1.png';
} elseif (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/api/') !== false) {
    $logoPath = '../assets/images/image1.png';
} else {
    $logoPath = 'assets/images/image1.png';
}

// Déterminer le chemin du CSS
$cssPath = getAssetPath('assets/css/style.css');
if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
    $cssPath = '../assets/css/style.css';
} elseif (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/api/') !== false) {
    $cssPath = '../assets/css/style.css';
} else {
    $cssPath = 'assets/css/style.css';
}

// Déterminer la page active
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>BusLik</title>
    <link rel="stylesheet" href="<?php echo $cssPath . '?v=' . time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .unified-nav {
            background: #111632;
            color: #FFFFFF;
            padding: 1.25rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        .unified-nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .unified-nav-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        .unified-nav-brand img {
            height: 35px;
            width: auto;
        }
        .unified-nav-brand span {
            color: #FFFFFF;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .unified-nav-menu {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .unified-nav-menu a {
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
            padding-bottom: 0.5rem;
        }
        .unified-nav-menu a:hover,
        .unified-nav-menu a.active {
            color: #FF7A2A;
        }
        .unified-nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #FF7A2A;
        }
        .unified-nav-auth {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .unified-nav-auth a {
            padding: 0.625rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }
        .unified-nav-auth .btn-login {
            background: #FF7A2A;
            color: #FFFFFF;
        }
        .unified-nav-auth .btn-signup {
            background: #4A6ED1;
            color: #FFFFFF;
        }
        .unified-nav-auth .btn-login:hover {
            background: #e66a1f;
        }
        .unified-nav-auth .btn-signup:hover {
            background: #3A5AB8;
        }
        .unified-nav-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .unified-nav-user a {
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body style="background: #111632; min-height: 100vh;">
    <nav class="unified-nav">
        <div class="unified-nav-container">
            <a href="index.php" class="unified-nav-brand">
                <img src="<?php echo $logoPath; ?>" alt="BusLik Logo">
                <span>BusLik</span>
            </a>

            <ul class="unified-nav-menu">
                <li><a href="index.php" class="<?php echo $currentPage == 'index' ? 'active' : ''; ?>">Accueil</a></li>
                <li><a href="horaires.php" class="<?php echo $currentPage == 'horaires' ? 'active' : ''; ?>">Horaires</a></li>
                <li><a href="lignes.php" class="<?php echo $currentPage == 'lignes' ? 'active' : ''; ?>">Nos Destinations</a></li>
                <li><a href="stations.php" class="<?php echo $currentPage == 'stations' ? 'active' : ''; ?>">Stations</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php" class="<?php echo $currentPage == 'dashboard' ? 'active' : ''; ?>">Tableau de bord</a></li>
                <?php endif; ?>
            </ul>

            <div class="unified-nav-auth">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="unified-nav-user">
                        <a href="profil.php">👤 <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Profil'); ?></a>
                        <a href="logout.php" style="color: #FF7A2A;">Déconnexion</a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn-login">Login</a>
                    <a href="register.php" class="btn-signup">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
