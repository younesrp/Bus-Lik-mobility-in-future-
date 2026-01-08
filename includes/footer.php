    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Bus-Lik</h3>
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
                <p>&copy; <?php echo date('Y'); ?> Bus-Lik. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <script src="<?php echo getAssetPath('assets/js/main.js'); ?>"></script>
</body>
</html>
