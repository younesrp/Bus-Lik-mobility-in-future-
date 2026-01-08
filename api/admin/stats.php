<?php
header("Content-Type: application/json");
require_once '../config/Db.php';

$conn = Db::connection();

try {
    // Example: total trips and revenue
    $stmt = $conn->query("SELECT COUNT(*) as total_trips, SUM(price) as total_revenue FROM trips");
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "success", "stats" => $stats]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
