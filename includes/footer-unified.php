    <footer style="background: #111632; color: rgba(255, 255, 255, 0.8); padding: 3rem 0 1.5rem; margin-top: 4rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <?php
                    $logoPath = getAssetPath('assets/images/image1.png');
                    if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
                        $logoPath = '../assets/images/image1.png';
                    } elseif (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/api/') !== false) {
                        $logoPath = '../assets/images/image1.png';
                    } else {
                        $logoPath = 'assets/images/image1.png';
                    }
                    ?>
                    <img src="<?php echo $logoPath; ?>" alt="BusLik Logo" style="height: 40px; width: auto; margin-bottom: 1rem;">
                    <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; line-height: 1.6;">Votre solution de transport urbain moderne et connectée.</p>
                </div>
                <div>
                    <h4 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem;">Liens rapides</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 0.5rem;"><a href="stations.php" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: color 0.3s;">Stations</a></li>
                        <li style="margin-bottom: 0.5rem;"><a href="lignes.php" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: color 0.3s;">Lignes</a></li>
                        <li style="margin-bottom: 0.5rem;"><a href="horaires.php" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: color 0.3s;">Horaires</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem;">Support</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 0.5rem;"><a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: color 0.3s;">Aide</a></li>
                        <li style="margin-bottom: 0.5rem;"><a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: color 0.3s;">Contact</a></li>
                        <li style="margin-bottom: 0.5rem;"><a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: color 0.3s;">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div style="text-align: center; padding-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.875rem; margin: 0;">&copy; <?php echo date('Y'); ?> BusLik. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <?php
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
