<?php
require_once __DIR__ . '/../models/Horaire.php';
require_once __DIR__ . '/../models/Line.php';
require_once __DIR__ . '/../models/Station.php';

class HoraireController {
    private $horaireModel;
    private $lineModel;
    private $stationModel;
    
    public function __construct($db) {
        $this->horaireModel = new Horaire($db);
        $this->lineModel = new Line($db);
        $this->stationModel = new Station($db);
    }
    
    /**
     * Afficher les horaires d'une ligne
     */
    public function showLineHoraires($line_id) {
        $line = $this->lineModel->getById($line_id);
        $horaires = $this->horaireModel->getHorairesByLine($line_id);
        
        return [
            'line' => $line,
            'horaires' => $this->horaireModel->formatHorairesForDisplay($horaires)
        ];
    }
    
    /**
     * Afficher les horaires d'une station
     */
    public function showStationHoraires($station_id) {
        $station = $this->stationModel->getById($station_id);
        $horaires = $this->horaireModel->getHorairesByStation($station_id);
        
        return [
            'station' => $station,
            'horaires' => $this->horaireModel->formatHorairesForDisplay($horaires),
            'next_passages' => $this->horaireModel->getNextPassages($station_id)
        ];
    }
    
    /**
     * API: Récupérer les prochains passages
     */
    public function getNextPassagesAPI($station_id) {
        $passages = $this->horaireModel->getNextPassages($station_id, null, 10);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $passages
        ]);
    }
    
    /**
     * Admin: Gérer les horaires
     */
    public function adminManage() {
        $horaires = $this->horaireModel->getAll();
        $lines = $this->lineModel->getAll();
        $stations = $this->stationModel->getAll();
        
        return [
            'horaires' => $horaires,
            'lines' => $lines,
            'stations' => $stations
        ];
    }
    
    /**
     * Admin: Ajouter un horaire
     */
    public function adminAdd($data) {
        $this->horaireModel->line_id = $data['line_id'];
        $this->horaireModel->station_id = $data['station_id'];
        $this->horaireModel->time = $data['time'];
        $this->horaireModel->day_type = $data['day_type'];
        $this->horaireModel->direction = $data['direction'];
        $this->horaireModel->station_order = $data['station_order'];
        
        if ($this->horaireModel->create()) {
            return ['success' => true, 'message' => 'Horaire ajouté avec succès'];
        }
        
        return ['success' => false, 'message' => 'Erreur lors de l\'ajout'];
    }
}
?>
