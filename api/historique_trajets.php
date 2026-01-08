<?php
header("Content-Type: application/json");
require_once '../config/Db.php';

$conn = Db::connection();

$user_id = $_GET['user_id'] ?? 0;
if (!$user_id) {
    echo json_encode(["status" => "error", "message" => "User ID required"]);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT * FROM trips WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "success", "trips" => $trips]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
