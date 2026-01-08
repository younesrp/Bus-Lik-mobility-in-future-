<?php
/**
 * Fonction pour obtenir le chemin de base des assets
 * @return string Le chemin de base relatif
 */
function getBasePath() {
    // Obtenir le chemin du script actuel
    $scriptPath = $_SERVER['PHP_SELF'];
    
    // Si on est dans admin ou api, retourner ../
    if (strpos($scriptPath, '/admin/') !== false || strpos($scriptPath, '/api/') !== false) {
        return '../';
    }
    
    // Si on est dans public, retourner ../
    if (strpos($scriptPath, '/public/') !== false) {
        return '../';
    }
    
    // Sinon, on est à la racine
    return '';
}

/**
 * Fonction pour obtenir le chemin absolu des assets
 * @param string $file Chemin du fichier depuis la racine
 * @return string Chemin absolu
 */
function getAssetPath($file) {
    $basePath = getBasePath();
    return $basePath . $file;
}
?>
