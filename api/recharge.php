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
    $stmt = $conn->prepare("SELECT balance FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $balance = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($balance) {
        echo json_encode(["status" => "success", "balance" => $balance['balance']]);
    } else {
        echo json_encode(["status" => "error", "message" => "User not found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
