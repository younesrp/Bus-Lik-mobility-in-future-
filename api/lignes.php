<?php
header('Content-Type: application/json');
require_once '../config/Db.php';
require_once '../app/models/Ligne.php';

try {
    $ligne = new Ligne();
    $lignes = $ligne->getAll();
    
    echo json_encode([
        'status' => 'success',
        'data' => $lignes
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
