<?php
header('Content-Type: application/json');
require_once '../config/Db.php';
require_once '../app/models/QRToken.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$token = $data['token'] ?? $_POST['token'] ?? '';

if (empty($token)) {
    echo json_encode(['status' => 'error', 'message' => 'Token requis']);
    exit;
}

try {
    $db = Db::connection();
    $qrToken = new QRToken($db);
    
    $tokenData = $qrToken->getByToken($token);
    
    if (!$tokenData) {
        echo json_encode(['status' => 'error', 'message' => 'Token invalide']);
        exit;
    }
    
    if ($tokenData['used_at']) {
        echo json_encode(['status' => 'error', 'message' => 'Token déjà utilisé']);
        exit;
    }
    
    if (strtotime($tokenData['expires_at']) < time()) {
        echo json_encode(['status' => 'error', 'message' => 'Token expiré']);
        exit;
    }
    
    // Marquer le token comme utilisé
    $qrToken->markAsUsed($tokenData['id']);
    
    // Mettre à jour le statut du trajet
    $stmt = $db->prepare("UPDATE trips SET status = 'completed' WHERE id = :trip_id");
    $stmt->bindParam(':trip_id', $tokenData['trip_id']);
    $stmt->execute();
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Token validé avec succès',
        'trip_id' => $tokenData['trip_id']
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
