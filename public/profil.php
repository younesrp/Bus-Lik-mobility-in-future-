<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Profil";
require_once '../includes/header-unified.php';

require_once '../config/Db.php';
require_once '../app/models/User.php';

$db = Db::connection();
$userModel = new User($db);
$user = $userModel->getById($_SESSION['user_id']);

// Get wallet
$stmt = $db->prepare("SELECT balance FROM wallets WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$wallet = $stmt->fetch(PDO::FETCH_ASSOC);
$balance = $wallet['balance'] ?? 0.00;
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Mon Profil</h1>
        
        <div style="background: rgba(255,255,255,0.1); padding: 2.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
            <div style="margin-bottom: 2rem;">
                <label style="color: rgba(255,255,255,0.7); font-size: 0.9rem; display: block; margin-bottom: 0.5rem;">Nom complet</label>
                <div style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 8px; color: #FFFFFF; font-size: 1.1rem;">
                    <?php echo htmlspecialchars($user['fullname'] ?? ''); ?>
                </div>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <label style="color: rgba(255,255,255,0.7); font-size: 0.9rem; display: block; margin-bottom: 0.5rem;">Email</label>
                <div style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 8px; color: #FFFFFF; font-size: 1.1rem;">
                    <?php echo htmlspecialchars($user['email'] ?? ''); ?>
                </div>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <label style="color: rgba(255,255,255,0.7); font-size: 0.9rem; display: block; margin-bottom: 0.5rem;">Solde</label>
                <div style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 8px; color: #FF7A2A; font-size: 1.5rem; font-weight: 700;">
                    <?php echo number_format($balance, 2); ?> DH
                </div>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <label style="color: rgba(255,255,255,0.7); font-size: 0.9rem; display: block; margin-bottom: 0.5rem;">Membre depuis</label>
                <div style="background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 8px; color: #FFFFFF; font-size: 1.1rem;">
                    <?php echo date('d/m/Y', strtotime($user['created_at'] ?? 'now')); ?>
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <a href="recharge.php" style="background: #FF7A2A; color: #FFFFFF; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; flex: 1; text-align: center;">
                    Recharger
                </a>
                <a href="dashboard.php" style="background: rgba(255,255,255,0.1); color: #FFFFFF; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; flex: 1; text-align: center; border: 1px solid rgba(255,255,255,0.2);">
                    Retour
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer-unified.php'; ?>
