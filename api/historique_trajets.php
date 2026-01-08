<?php
header('Content-Type: application/json');
session_start();
require_once '../config/Db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Non authentifié']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $db = Db::connection();
    
    $stmt = $db->prepare("
        SELECT t.*, 
               l.name as line_name, 
               l.code as line_code,
               s1.name as start_station_name,
               s2.name as end_station_name
        FROM trips t
        LEFT JOIN lines l ON t.line_id = l.id
        LEFT JOIN stations s1 ON t.start_station_id = s1.id
        LEFT JOIN stations s2 ON t.end_station_id = s2.id
        WHERE t.user_id = :user_id
        ORDER BY t.created_at DESC
        LIMIT 50
    ");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'data' => $trips
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
