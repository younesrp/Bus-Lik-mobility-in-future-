<?php
$pageTitle = "Stations";
require_once '../includes/header-unified.php';
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Stations</h1>
        
        <div id="stations-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            <!-- Stations will be loaded here -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('../api/stations.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const container = document.getElementById('stations-container');
                if (data.data.length === 0) {
                    container.innerHTML = '<p style="color: rgba(255,255,255,0.7); text-align: center; grid-column: 1/-1;">Aucune station disponible</p>';
                } else {
                    container.innerHTML = data.data.map(station => `
                        <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2);">
                            <h3 style="color: #FFFFFF; font-size: 1.25rem; margin-bottom: 0.5rem;">${station.name}</h3>
                            <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin: 0.25rem 0;">
                                <i class="fa-solid fa-location-dot" style="color: #4A6ED1; margin-right: 0.5rem;"></i>
                                ${station.latitude}, ${station.longitude}
                            </p>
                        </div>
                    `).join('');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('stations-container').innerHTML = '<p style="color: #FF7A2A; text-align: center; grid-column: 1/-1;">Erreur lors du chargement des stations</p>';
        });
});
</script>

<?php require_once '../includes/footer-unified.php'; ?>
