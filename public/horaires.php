<?php
$pageTitle = "Horaires";
require_once '../includes/header-unified.php';
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Horaires</h1>
        
        <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px; margin-bottom: 2rem;">
            <label style="color: #FFFFFF; display: block; margin-bottom: 0.5rem; font-weight: 500;">Sélectionner une ligne</label>
            <select id="line-select" style="width: 100%; padding: 0.875rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.1); color: #FFFFFF; font-size: 1rem;">
                <option value="">-- Choisir une ligne --</option>
            </select>
        </div>
        
        <div id="horaires-container">
            <!-- Horaires will be loaded here -->
        </div>
    </div>
</div>

<script>
let lignes = [];

document.addEventListener('DOMContentLoaded', function() {
    // Load lines
    fetch('../api/lignes.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                lignes = data.data;
                const select = document.getElementById('line-select');
                select.innerHTML = '<option value="">-- Choisir une ligne --</option>' + 
                    data.data.map(ligne => `<option value="${ligne.id}">${ligne.code} - ${ligne.name}</option>`).join('');
            }
        });
    
    // Load horaires when line is selected
    document.getElementById('line-select').addEventListener('change', function() {
        const lineId = this.value;
        if (lineId) {
            fetch(`../api/horaires.php?line_id=${lineId}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('horaires-container');
                    if (data.status === 'success' && data.data.length > 0) {
                        container.innerHTML = `
                            <div style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 16px;">
                                <h2 style="color: #FFFFFF; margin-bottom: 1.5rem;">Horaires de la ligne</h2>
                                <div style="display: grid; gap: 1rem;">
                                    ${data.data.map(horaire => `
                                        <div style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                                            <div>
                                                <p style="color: #FFFFFF; font-weight: 500; margin: 0;">${horaire.station_name || 'Station'}</p>
                                                <p style="color: rgba(255,255,255,0.7); font-size: 0.875rem; margin: 0.25rem 0 0 0;">${horaire.day_type || 'Journée'}</p>
                                            </div>
                                            <div style="color: #FF7A2A; font-weight: 600; font-size: 1.1rem;">
                                                ${horaire.time || 'N/A'}
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        `;
                    } else {
                        container.innerHTML = '<p style="color: rgba(255,255,255,0.7); text-align: center;">Aucun horaire disponible pour cette ligne</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('horaires-container').innerHTML = '<p style="color: #FF7A2A; text-align: center;">Erreur lors du chargement des horaires</p>';
                });
        } else {
            document.getElementById('horaires-container').innerHTML = '';
        }
    });
});
</script>

<?php require_once '../includes/footer-unified.php'; ?>
