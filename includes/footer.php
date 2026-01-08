    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Bus-Lik</h3>
                    <p>Votre solution de transport urbain moderne et connectée. Simplifiez vos déplacements avec notre plateforme intuitive.</p>
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
                        <li><a href="<?php echo $basePath; ?>public/abonnement.php">Abonnements</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Centre d'aide</a></li>
                        <li><a href="#">Nous contacter</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span><?php echo date('Y'); ?> Bus-Lik</span>
                <span>•</span>
                <span>Tous droits réservés</span>
                <span>•</span>
                <span>Transport urbain intelligent</span>
            </div>
        </div>
    </footer>
    <?php
    // Déterminer le chemin du JS
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
