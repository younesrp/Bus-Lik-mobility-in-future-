<?php
header('Content-Type: application/json');
require_once '../config/Db.php';
require_once '../app/models/Ligne.php';
require_once '../app/models/Station.php';

$line_id = $_GET['line_id'] ?? null;

if (!$line_id) {
    echo json_encode(['status' => 'error', 'message' => 'line_id required']);
    exit;
}

try {
    $ligne = new Ligne();
    $line = $ligne->getById($line_id);
    
    if (!$line) {
        echo json_encode(['status' => 'error', 'message' => 'Line not found']);
        exit;
    }
    
    $station = new Station();
    $stations = $station->getStationsByLine($line_id);
    
    echo json_encode([
        'status' => 'success',
        'line' => $line,
        'stations' => $stations
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
