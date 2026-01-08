<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Abonnement";
require_once '../includes/header-unified.php';

require_once '../config/Db.php';
$db = Db::connection();

// Get subscription
$stmt = $db->prepare("SELECT * FROM subscriptions WHERE user_id = :user_id ORDER BY end_date DESC LIMIT 1");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$subscription = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Abonnements</h1>
        
        <?php if ($subscription && $subscription['is_active']): ?>
            <div style="background: rgba(72,187,120,0.2); padding: 2rem; border-radius: 16px; border: 2px solid #48BB78; margin-bottom: 2rem; text-align: center;">
                <h2 style="color: #48BB78; font-size: 1.5rem; margin-bottom: 1rem;">✅ Abonnement Actif</h2>
                <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 0.5rem;">
                    Type: <strong><?php echo ucfirst($subscription['type']); ?></strong>
                </p>
                <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem;">
                    Valide jusqu'au: <strong><?php echo date('d/m/Y', strtotime($subscription['end_date'])); ?></strong>
                </p>
            </div>
        <?php else: ?>
            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2); margin-bottom: 2rem; text-align: center;">
                <p style="color: rgba(255,255,255,0.7); font-size: 1.1rem;">Vous n'avez pas d'abonnement actif</p>
            </div>
        <?php endif; ?>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
                <h3 style="color: #FFFFFF; font-size: 1.5rem; margin-bottom: 1rem;">Basic</h3>
                <p style="color: #FF7A2A; font-size: 2rem; font-weight: 700; margin-bottom: 1rem;">50 DH/mois</p>
                <ul style="color: rgba(255,255,255,0.8); list-style: none; padding: 0; margin-bottom: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">✓ Trajets illimités</li>
                    <li style="margin-bottom: 0.5rem;">✓ Prix réduit: 2 DH/trajet</li>
                </ul>
                <button style="width: 100%; background: #4A6ED1; color: #FFFFFF; padding: 1rem; border-radius: 8px; border: none; font-weight: 600; cursor: pointer;">
                    Choisir Basic
                </button>
            </div>
            
            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; border: 2px solid #FF7A2A;">
                <div style="background: #FF7A2A; color: #FFFFFF; padding: 0.5rem 1rem; border-radius: 6px; display: inline-block; margin-bottom: 1rem; font-size: 0.85rem; font-weight: 600;">
                    POPULAIRE
                </div>
                <h3 style="color: #FFFFFF; font-size: 1.5rem; margin-bottom: 1rem;">Premium</h3>
                <p style="color: #FF7A2A; font-size: 2rem; font-weight: 700; margin-bottom: 1rem;">100 DH/mois</p>
                <ul style="color: rgba(255,255,255,0.8); list-style: none; padding: 0; margin-bottom: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">✓ Trajets illimités</li>
                    <li style="margin-bottom: 0.5rem;">✓ Prix réduit: 1.5 DH/trajet</li>
                    <li style="margin-bottom: 0.5rem;">✓ Support prioritaire</li>
                </ul>
                <button style="width: 100%; background: #FF7A2A; color: #FFFFFF; padding: 1rem; border-radius: 8px; border: none; font-weight: 600; cursor: pointer;">
                    Choisir Premium
                </button>
            </div>
            
            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
                <h3 style="color: #FFFFFF; font-size: 1.5rem; margin-bottom: 1rem;">Student</h3>
                <p style="color: #B59A90; font-size: 2rem; font-weight: 700; margin-bottom: 1rem;">30 DH/mois</p>
                <ul style="color: rgba(255,255,255,0.8); list-style: none; padding: 0; margin-bottom: 1.5rem;">
                    <li style="margin-bottom: 0.5rem;">✓ Trajets illimités</li>
                    <li style="margin-bottom: 0.5rem;">✓ Prix réduit: 1 DH/trajet</li>
                    <li style="margin-bottom: 0.5rem;">✓ Réservé aux étudiants</li>
                </ul>
                <button style="width: 100%; background: #B59A90; color: #FFFFFF; padding: 1rem; border-radius: 8px; border: none; font-weight: 600; cursor: pointer;">
                    Choisir Student
                </button>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer-unified.php'; ?>
