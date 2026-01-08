<?php
header('Content-Type: application/json');
require_once '../config/Db.php';
require_once '../app/models/Horaire.php';
require_once '../app/models/Ligne.php';

$line_id = $_GET['line_id'] ?? null;
$station_id = $_GET['station_id'] ?? null;

try {
    $horaire = new Horaire();
    
    if ($line_id && $station_id) {
        $horaires = $horaire->getHorairesByLineStation($line_id, $station_id);
    } elseif ($line_id) {
        $horaires = $horaire->getHorairesByLine($line_id);
    } else {
        // Retourner tous les horaires groupés par ligne
        $ligne = new Ligne();
        $lignes = $ligne->getAll();
        $result = [];
        
        foreach ($lignes as $line) {
            $result[] = [
                'line' => $line,
                'horaires' => $horaire->getHorairesByLine($line['id'])
            ];
        }
        
        echo json_encode([
            'status' => 'success',
            'data' => $result
        ]);
        exit;
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $horaires
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
