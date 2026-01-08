<?php
header('Content-Type: application/json');
session_start();
require_once '../config/Db.php';
require_once '../app/models/QRToken.php';
require_once '../app/models/Trip.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Non authentifié']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$line_id = intval($data['line_id'] ?? $_POST['line_id'] ?? 0);
$start_station_id = intval($data['start_station_id'] ?? $_POST['start_station_id'] ?? 0);
$end_station_id = intval($data['end_station_id'] ?? $_POST['end_station_id'] ?? 0);
$user_id = $_SESSION['user_id'];

if (!$line_id || !$start_station_id || !$end_station_id) {
    echo json_encode(['status' => 'error', 'message' => 'Paramètres manquants']);
    exit;
}

try {
    $db = Db::connection();
    
    // Vérifier le solde
    $stmt = $db->prepare("SELECT balance FROM wallets WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $wallet = $stmt->fetch(PDO::FETCH_ASSOC);
    $balance = $wallet['balance'] ?? 0;
    $price = 2.00; // Prix fixe pour l'instant
    
    if ($balance < $price) {
        echo json_encode(['status' => 'error', 'message' => 'Solde insuffisant']);
        exit;
    }
    
    // Créer le trajet
    $trip = new Trip($db);
    $trip->user_id = $user_id;
    $trip->line_id = $line_id;
    $trip->start_station_id = $start_station_id;
    $trip->end_station_id = $end_station_id;
    $trip->price = $price;
    $trip->status = 'pending';
    
    $tripId = $trip->create();
    
    if ($tripId) {
        // Débiter le wallet
        $newBalance = $balance - $price;
        $stmt = $db->prepare("UPDATE wallets SET balance = :balance WHERE user_id = :user_id");
        $stmt->bindParam(':balance', $newBalance);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        // Générer le QR token
        $qrToken = new QRToken($db);
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+2 hours'));
        
        $qrId = $qrToken->create($tripId, $token, $expiresAt);
        
        echo json_encode([
            'status' => 'success',
            'token' => $token,
            'trip_id' => $tripId,
            'expires_at' => $expiresAt,
            'new_balance' => $newBalance
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la création du trajet']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
