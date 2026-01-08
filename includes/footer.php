    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <?php
                    // S'assurer que getAssetPath est disponible
                    if (!function_exists('getAssetPath')) {
                        require_once __DIR__ . '/functions.php';
                    }
                    // Déterminer le chemin du logo (même logique que le header)
                    $logoPath = getAssetPath('assets/images/image1.png');
                    if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
                        $logoPath = '../assets/images/image1.png';
                    } elseif (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/api/') !== false) {
                        $logoPath = '../assets/images/image1.png';
                    } else {
                        $logoPath = 'assets/images/image1.png';
                    }
                    ?>
                    <img src="<?php echo $logoPath; ?>" alt="BusLik Logo" style="height: 50px; width: auto; max-width: 150px; margin-bottom: 1rem;">
                    <p>Votre solution de transport urbain moderne et connectée.</p>
                </div>
                <div class="footer-section">
                    <h4>Liens rapides</h4>
<?php
// Utiliser la fonction getBasePath() déjà déclarée dans functions.php
if (!function_exists('getBasePath')) {
    require_once __DIR__ . '/functions.php';
}
$basePath = getBasePath();
?>
                    <ul>
                        <li><a href="<?php echo $basePath; ?>public/stations.php">Stations</a></li>
                        <li><a href="<?php echo $basePath; ?>public/lignes.php">Lignes</a></li>
                        <li><a href="<?php echo $basePath; ?>public/horaires.php">Horaires</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Aide</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <?php
    // Déterminer le chemin du JS (même logique que le header)
    if (!function_exists('getAssetPath')) {
        require_once __DIR__ . '/functions.php';
    }
    $jsPath = getAssetPath('assets/js/main.js');
    if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
        $jsPath = '../assets/js/main.js';
    } elseif (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/api/') !== false) {
        $jsPath = '../assets/js/main.js';
    } else {
        $jsPath = 'assets/js/main.js';
    }
    ?>
    <script src="<?php echo $jsPath; ?>"></script>
</body>
</html>
