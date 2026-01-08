<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Historique";
require_once '../includes/header-unified.php';
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Historique des trajets</h1>
        
        <div id="historique-container" style="display: grid; gap: 1rem;">
            <!-- Trips will be loaded here -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('../api/historique_trajets.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('historique-container');
            if (data.status === 'success' && data.data.length > 0) {
                container.innerHTML = data.data.map(trip => `
                    <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; display: flex; align-items: center; gap: 1.5rem; border: 1px solid rgba(255,255,255,0.2);">
                        <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <img src="../assets/images/image1.png" alt="Bus" style="height: 30px; width: auto;">
                        </div>
                        <div style="flex: 1;">
                            <h4 style="color: #FFFFFF; font-size: 1.1rem; margin-bottom: 0.25rem;">
                                ${trip.line_name || 'Ligne'} - ${trip.start_station_name || 'Départ'} → ${trip.end_station_name || 'Arrivée'}
                            </h4>
                            <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin: 0;">
                                ${new Date(trip.created_at).toLocaleString('fr-FR')} - 
                                <span style="color: ${trip.status === 'completed' ? '#48BB78' : trip.status === 'in_progress' ? '#FF7A2A' : '#718096'};">
                                    ${trip.status === 'completed' ? 'Terminé' : trip.status === 'in_progress' ? 'En cours' : 'En attente'}
                                </span>
                            </p>
                        </div>
                        <div style="color: #FF7A2A; font-weight: 600; font-size: 1.1rem;">
                            -${parseFloat(trip.price).toFixed(2)} DH
                        </div>
                    </div>
                `).join('');
            } else {
                container.innerHTML = '<p style="color: rgba(255,255,255,0.7); text-align: center; padding: 2rem;">Aucun trajet dans l\'historique</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('historique-container').innerHTML = '<p style="color: #FF7A2A; text-align: center;">Erreur lors du chargement de l\'historique</p>';
        });
});
</script>

<?php require_once '../includes/footer-unified.php'; ?>
