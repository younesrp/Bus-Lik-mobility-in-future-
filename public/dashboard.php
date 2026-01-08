<?php
$pageTitle = "Tableau de bord";
require_once '../includes/header.php';

// Simulation de données utilisateur (à remplacer par la vraie logique)
$userName = "Younes";
$balance = 150.00;
$subscriptionActive = true;
$totalTrips = 24;
$thisMonthTrips = 8;
?>

<div class="dashboard-container">
    <div class="container">
        <!-- Welcome Section -->
        <div class="dashboard-welcome">
            <div class="welcome-content">
                <h1>Bienvenue, <?php echo htmlspecialchars($userName); ?> ! 👋</h1>
                <p>Gérez vos trajets et votre abonnement en toute simplicité</p>
            </div>
            <div class="welcome-actions">
                <a href="recharge.php" class="btn-primary">
                    <span>💳</span>
                    <span>Recharger</span>
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #4A6ED1 0%, #3A5AB8 100%);">
                    💰
                </div>
                <div class="stat-content">
                    <h3>Solde</h3>
                    <p class="stat-value"><?php echo number_format($balance, 2); ?> DH</p>
                    <span class="stat-label">Crédit disponible</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);">
                    🎫
                </div>
                <div class="stat-content">
                    <h3>Abonnement</h3>
                    <p class="stat-value"><?php echo $subscriptionActive ? 'Actif' : 'Inactif'; ?></p>
                    <span class="stat-label"><?php echo $subscriptionActive ? 'Jusqu\'au 31/12/2024' : 'Non abonné'; ?></span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ED8936 0%, #DD6B20 100%); display: flex; align-items: center; justify-content: center;">
                    <img src="../assets/images/image1.png" alt="Bus" style="height: 30px; width: auto; max-width: 40px;">
                </div>
                <div class="stat-content">
                    <h3>Trajets</h3>
                    <p class="stat-value"><?php echo $thisMonthTrips; ?></p>
                    <span class="stat-label">Ce mois (Total: <?php echo $totalTrips; ?>)</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #9F7AEA 0%, #805AD5 100%);">
                    📊
                </div>
                <div class="stat-content">
                    <h3>Économies</h3>
                    <p class="stat-value"><?php echo number_format($thisMonthTrips * 3, 2); ?> DH</p>
                    <span class="stat-label">Grâce à l'abonnement</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-section">
            <h2 class="section-title">Actions rapides</h2>
            <div class="actions-grid">
                <a href="stations.php" class="action-card">
                    <div class="action-icon">📍</div>
                    <h3>Stations</h3>
                    <p>Consulter les stations disponibles</p>
                </a>

                <a href="lignes.php" class="action-card">
                    <div class="action-icon">🛣️</div>
                    <h3>Lignes</h3>
                    <p>Voir toutes les lignes de bus</p>
                </a>

                <a href="qr-code.php" class="action-card">
                    <div class="action-icon">📱</div>
                    <h3>QR Code</h3>
                    <p>Générer un code pour votre trajet</p>
                </a>

                <a href="abonnement.php" class="action-card">
                    <div class="action-icon">🎫</div>
                    <h3>Abonnement</h3>
                    <p>Gérer votre abonnement</p>
                </a>

                <a href="recharge.php" class="action-card">
                    <div class="action-icon">💳</div>
                    <h3>Recharger</h3>
                    <p>Ajouter du crédit à votre compte</p>
                </a>

                <a href="historique.php" class="action-card">
                    <div class="action-icon">📜</div>
                    <h3>Historique</h3>
                    <p>Consulter vos trajets passés</p>
                </a>
            </div>
        </div>

        <!-- Recent Trips -->
        <div class="dashboard-section">
            <h2 class="section-title">Trajets récents</h2>
            <div class="trips-list">
                <div class="trip-item">
                    <div class="trip-icon"><img src="../assets/images/image1.png" alt="Bus" style="height: 24px; width: auto; max-width: 30px;"></div>
                    <div class="trip-details">
                        <h4>Ligne 12 - Station Centre</h4>
                        <p>Aujourd'hui à 14:30</p>
                    </div>
                    <div class="trip-price">-2.00 DH</div>
                </div>

                <div class="trip-item">
                    <div class="trip-icon"><img src="../assets/images/image1.png" alt="Bus" style="height: 24px; width: auto; max-width: 30px;"></div>
                    <div class="trip-details">
                        <h4>Ligne 8 - Station Université</h4>
                        <p>Hier à 08:15</p>
                    </div>
                    <div class="trip-price">-2.00 DH</div>
                </div>

                <div class="trip-item">
                    <div class="trip-icon"><img src="../assets/images/image1.png" alt="Bus" style="height: 24px; width: auto; max-width: 30px;"></div>
                    <div class="trip-details">
                        <h4>Ligne 5 - Station Marché</h4>
                        <p>Il y a 2 jours à 16:45</p>
                    </div>
                    <div class="trip-price">-2.00 DH</div>
                </div>
            </div>
            <div class="view-all">
                <a href="historique.php" class="btn-secondary">Voir tout l'historique →</a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
