<?php
header("Content-Type: application/json");
require_once '../config/Db.php';

$conn = Db::connection();

try {
    // Get all lines
    $stmt = $conn->query("SELECT * FROM lines");
    $lines = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($lines as &$line) {
        // Get stations for each line
        $stmt2 = $conn->prepare("SELECT * FROM stations WHERE line_id = :line_id");
        $stmt2->bindParam(':line_id', $line['id']);
        $stmt2->execute();
        $line['stations'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode(["status" => "success", "lines" => $lines]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
