<?php
header('Content-Type: application/json');
session_start();
require_once '../config/Db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Non authentifié']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$amount = floatval($data['amount'] ?? $_POST['amount'] ?? 0);
$user_id = $_SESSION['user_id'];

if ($amount <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Montant invalide']);
    exit;
}

try {
    $db = Db::connection();
    
    // Vérifier si le wallet existe, sinon le créer
    $stmt = $db->prepare("SELECT id, balance FROM wallets WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $wallet = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($wallet) {
        $newBalance = $wallet['balance'] + $amount;
        $stmt = $db->prepare("UPDATE wallets SET balance = :balance WHERE user_id = :user_id");
        $stmt->bindParam(':balance', $newBalance);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    } else {
        $stmt = $db->prepare("INSERT INTO wallets (user_id, balance) VALUES (:user_id, :balance)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':balance', $amount);
        $stmt->execute();
        $newBalance = $amount;
    }
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Recharge effectuée avec succès',
        'new_balance' => $newBalance
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>