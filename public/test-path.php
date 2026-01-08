<?php
require_once '../includes/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test CSS Path</title>
</head>
<body>
    <h1>Test du chemin CSS</h1>
    <p><strong>Script Path:</strong> <?php echo $_SERVER['PHP_SELF']; ?></p>
    <p><strong>Base Path:</strong> <?php echo getBasePath(); ?></p>
    <p><strong>CSS Path:</strong> <?php echo getAssetPath('assets/css/style.css'); ?></p>
    <p><strong>File exists:</strong> <?php echo file_exists(__DIR__ . '/../' . getAssetPath('assets/css/style.css')) ? 'OUI' : 'NON'; ?></p>
    <p><strong>Full path:</strong> <?php echo __DIR__ . '/../' . getAssetPath('assets/css/style.css'); ?></p>
    
    <h2>Test du CSS</h2>
    <link rel="stylesheet" href="<?php echo getAssetPath('assets/css/style.css'); ?>">
    <div class="login-container" style="padding: 20px; background: #4A6ED1; color: white;">
        <p>Si vous voyez ce texte avec un fond bleu (#4A6ED1), le CSS fonctionne !</p>
    </div>
</body>
</html>
