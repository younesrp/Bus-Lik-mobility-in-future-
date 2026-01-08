<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Tableau de bord";
require_once '../includes/header-unified.php';

require_once '../config/Db.php';
$db = Db::connection();

// Get user balance
$stmt = $db->prepare("SELECT balance FROM wallets WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$wallet = $stmt->fetch(PDO::FETCH_ASSOC);
$balance = $wallet['balance'] ?? 0.00;

// Get subscription
$stmt = $db->prepare("SELECT * FROM subscriptions WHERE user_id = :user_id AND is_active = 1 ORDER BY end_date DESC LIMIT 1");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$subscription = $stmt->fetch(PDO::FETCH_ASSOC);
$subscriptionActive = $subscription ? true : false;

// Get trips count
$stmt = $db->prepare("SELECT COUNT(*) as total FROM trips WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$totalTrips = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

$stmt = $db->prepare("SELECT COUNT(*) as total FROM trips WHERE user_id = :user_id AND MONTH(created_at) = MONTH(CURRENT_DATE())");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$thisMonthTrips = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

// Get recent trips
$stmt = $db->prepare("SELECT t.*, l.name as line_name, s1.name as start_station, s2.name as end_station 
                      FROM trips t 
                      LEFT JOIN lines l ON t.line_id = l.id 
                      LEFT JOIN stations s1 ON t.start_station_id = s1.id 
                      LEFT JOIN stations s2 ON t.end_station_id = s2.id 
                      WHERE t.user_id = :user_id 
                      ORDER BY t.created_at DESC LIMIT 3");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$recentTrips = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <div>
                <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">
                    Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?> ! 👋
                </h1>
                <p style="color: rgba(255,255,255,0.7); font-size: 1.1rem;">Gérez vos trajets et votre abonnement</p>
            </div>
            <a href="recharge.php" style="background: #FF7A2A; color: #FFFFFF; padding: 0.875rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-credit-card"></i> Recharger
            </a>
        </div>

        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #4A6ED1 0%, #3A5AB8 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; font-size: 1.5rem;">
                    💰
                </div>
                <h3 style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 0.5rem;">Solde</h3>
                <p style="color: #FFFFFF; font-size: 2rem; font-weight: 700; margin: 0;"><?php echo number_format($balance, 2); ?> DH</p>
            </div>

            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #48BB78 0%, #38A169 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; font-size: 1.5rem;">
                    🎫
                </div>
                <h3 style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 0.5rem;">Abonnement</h3>
                <p style="color: #FFFFFF; font-size: 2rem; font-weight: 700; margin: 0;"><?php echo $subscriptionActive ? 'Actif' : 'Inactif'; ?></p>
            </div>

            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #FF7A2A 0%, #e66a1f 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <img src="../assets/images/image1.png" alt="Bus" style="height: 30px; width: auto;">
                </div>
                <h3 style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 0.5rem;">Trajets</h3>
                <p style="color: #FFFFFF; font-size: 2rem; font-weight: 700; margin: 0;"><?php echo $thisMonthTrips; ?></p>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-top: 0.25rem;">Total: <?php echo $totalTrips; ?></p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="margin-bottom: 3rem;">
            <h2 style="color: #FFFFFF; font-size: 1.75rem; font-weight: 600; margin-bottom: 1.5rem;">Actions rapides</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <a href="stations.php" style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; text-decoration: none; text-align: center; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">📍</div>
                    <h3 style="color: #FFFFFF; font-size: 1.1rem; margin: 0;">Stations</h3>
                </a>
                <a href="lignes.php" style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; text-decoration: none; text-align: center; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🛣️</div>
                    <h3 style="color: #FFFFFF; font-size: 1.1rem; margin: 0;">Lignes</h3>
                </a>
                <a href="qr-code.php" style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; text-decoration: none; text-align: center; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">📱</div>
                    <h3 style="color: #FFFFFF; font-size: 1.1rem; margin: 0;">QR Code</h3>
                </a>
                <a href="abonnement.php" style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; text-decoration: none; text-align: center; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎫</div>
                    <h3 style="color: #FFFFFF; font-size: 1.1rem; margin: 0;">Abonnement</h3>
                </a>
                <a href="recharge.php" style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; text-decoration: none; text-align: center; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">💳</div>
                    <h3 style="color: #FFFFFF; font-size: 1.1rem; margin: 0;">Recharger</h3>
                </a>
                <a href="historique.php" style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; text-decoration: none; text-align: center; border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">📜</div>
                    <h3 style="color: #FFFFFF; font-size: 1.1rem; margin: 0;">Historique</h3>
                </a>
            </div>
        </div>

        <!-- Recent Trips -->
        <div>
            <h2 style="color: #FFFFFF; font-size: 1.75rem; font-weight: 600; margin-bottom: 1.5rem;">Trajets récents</h2>
            <div id="recent-trips" style="display: grid; gap: 1rem;">
                <?php if (empty($recentTrips)): ?>
                    <p style="color: rgba(255,255,255,0.7); text-align: center; padding: 2rem;">Aucun trajet récent</p>
                <?php else: ?>
                    <?php foreach ($recentTrips as $trip): ?>
                        <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; display: flex; align-items: center; gap: 1.5rem; border: 1px solid rgba(255,255,255,0.2);">
                            <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <img src="../assets/images/image1.png" alt="Bus" style="height: 30px; width: auto;">
                            </div>
                            <div style="flex: 1;">
                                <h4 style="color: #FFFFFF; font-size: 1.1rem; margin-bottom: 0.25rem;">
                                    <?php echo htmlspecialchars($trip['line_name'] ?? 'Ligne'); ?> - 
                                    <?php echo htmlspecialchars($trip['start_station'] ?? 'Départ'); ?> → 
                                    <?php echo htmlspecialchars($trip['end_station'] ?? 'Arrivée'); ?>
                                </h4>
                                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin: 0;">
                                    <?php echo date('d/m/Y H:i', strtotime($trip['created_at'])); ?>
                                </p>
                            </div>
                            <div style="color: #FF7A2A; font-weight: 600; font-size: 1.1rem;">
                                -<?php echo number_format($trip['price'], 2); ?> DH
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div style="text-align: center; margin-top: 2rem;">
                <a href="historique.php" style="color: #FF7A2A; text-decoration: none; font-weight: 600;">Voir tout l'historique →</a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer-unified.php'; ?>
