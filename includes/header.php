<?php
// Inclure les fonctions utilitaires
require_once __DIR__ . '/functions.php';
$basePath = getBasePath();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Bus-Lik</title>
    <?php
    // Déterminer le chemin du CSS
    $cssPath = getAssetPath('assets/css/style.css');
    // Si on est dans public/, utiliser ../assets/css/style.css
    if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
        $cssPath = '../assets/css/style.css';
    } elseif (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/api/') !== false) {
        $cssPath = '../assets/css/style.css';
    } else {
        $cssPath = 'assets/css/style.css';
    }
    ?>
    <link rel="stylesheet" href="<?php echo $cssPath . '?v=' . time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-brand">
                    <a href="<?php echo $basePath; ?>public/index.php">
                        <span class="logo-icon">🚌</span>
                        <span class="logo-text">Bus-Lik</span>
                    </a>
                </div>
                <ul class="nav-menu">
                    <li><a href="<?php echo $basePath; ?>public/index.php">Accueil</a></li>
                    <li><a href="<?php echo $basePath; ?>public/stations.php">Stations</a></li>
                    <li><a href="<?php echo $basePath; ?>public/lignes.php">Lignes</a></li>
                    <li><a href="<?php echo $basePath; ?>public/login.php" class="btn-login">Connexion</a></li>
                </ul>
            </div>
        </nav>
    </header>
