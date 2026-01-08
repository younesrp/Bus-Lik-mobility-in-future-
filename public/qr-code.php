<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "QR Code";
require_once '../includes/header-unified.php';
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Générer un QR Code</h1>
        
        <div style="background: rgba(255,255,255,0.1); padding: 2.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2);">
            <form id="qr-form" style="display: grid; gap: 1.5rem;">
                <div>
                    <label style="color: rgba(255,255,255,0.9); font-size: 0.9rem; display: block; margin-bottom: 0.5rem; font-weight: 500;">Ligne</label>
                    <select id="line_id" required style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.1); color: #FFFFFF; font-size: 1rem;">
                        <option value="">-- Choisir une ligne --</option>
                    </select>
                </div>
                
                <div>
                    <label style="color: rgba(255,255,255,0.9); font-size: 0.9rem; display: block; margin-bottom: 0.5rem; font-weight: 500;">Station de départ</label>
                    <select id="start_station_id" required style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.1); color: #FFFFFF; font-size: 1rem;">
                        <option value="">-- Choisir une station --</option>
                    </select>
                </div>
                
                <div>
                    <label style="color: rgba(255,255,255,0.9); font-size: 0.9rem; display: block; margin-bottom: 0.5rem; font-weight: 500;">Station d'arrivée</label>
                    <select id="end_station_id" required style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.1); color: #FFFFFF; font-size: 1rem;">
                        <option value="">-- Choisir une station --</option>
                    </select>
                </div>
                
                <button type="submit" style="background: #FF7A2A; color: #FFFFFF; padding: 1rem 2rem; border-radius: 8px; border: none; font-weight: 600; font-size: 1rem; cursor: pointer;">
                    Générer le QR Code
                </button>
            </form>
            
            <div id="qr-result" style="margin-top: 2rem; text-align: center; display: none;">
                <div style="background: #FFFFFF; padding: 2rem; border-radius: 12px; display: inline-block;">
                    <div id="qrcode"></div>
                    <p style="color: #2D3748; margin-top: 1rem; font-weight: 600;" id="qr-token"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
let stations = [];

document.addEventListener('DOMContentLoaded', function() {
    // Load lines
    fetch('../api/lignes.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const select = document.getElementById('line_id');
                select.innerHTML = '<option value="">-- Choisir une ligne --</option>' + 
                    data.data.map(ligne => `<option value="${ligne.id}">${ligne.code} - ${ligne.name}</option>`).join('');
            }
        });
    
    // Load stations when line is selected
    document.getElementById('line_id').addEventListener('change', function() {
        const lineId = this.value;
        if (lineId) {
            fetch(`../api/lignes_stations.php?line_id=${lineId}`)
                .then(response => response.json())
                .then(data => {
                    stations = data.stations || [];
                    const startSelect = document.getElementById('start_station_id');
                    const endSelect = document.getElementById('end_station_id');
                    const options = '<option value="">-- Choisir une station --</option>' + 
                        stations.map(s => `<option value="${s.id}">${s.name}</option>`).join('');
                    startSelect.innerHTML = options;
                    endSelect.innerHTML = options;
                });
        }
    });
    
    // Handle form submission
    document.getElementById('qr-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const lineId = document.getElementById('line_id').value;
        const startStationId = document.getElementById('start_station_id').value;
        const endStationId = document.getElementById('end_station_id').value;
        
        fetch('../api/qr-generate.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({line_id: lineId, start_station_id: startStationId, end_station_id: endStationId})
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('qr-result').style.display = 'block';
                document.getElementById('qr-token').textContent = 'Token: ' + data.token;
                document.getElementById('qrcode').innerHTML = '';
                new QRCode(document.getElementById('qrcode'), {
                    text: data.token,
                    width: 256,
                    height: 256
                });
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de la génération du QR code');
        });
    });
});
</script>

<?php require_once '../includes/footer-unified.php'; ?>
