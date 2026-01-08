<?php
$pageTitle = "Lignes";
require_once '../includes/header-unified.php';
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Nos Destinations</h1>
        
        <div id="lignes-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            <!-- Lignes will be loaded here -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('../api/lignes.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const container = document.getElementById('lignes-container');
                if (data.data.length === 0) {
                    container.innerHTML = '<p style="color: rgba(255,255,255,0.7); text-align: center; grid-column: 1/-1;">Aucune ligne disponible</p>';
                } else {
                    container.innerHTML = data.data.map(ligne => `
                        <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer; transition: all 0.3s;" 
                             onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.transform='translateY(-5px)'"
                             onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                <div style="width: 50px; height: 50px; background: #4A6ED1; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #FFFFFF; font-weight: 700;">
                                    ${ligne.code}
                                </div>
                                <h3 style="color: #FFFFFF; font-size: 1.25rem; margin: 0;">${ligne.name}</h3>
                            </div>
                            <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin: 0;">
                                <i class="fa-solid fa-route" style="color: #FF7A2A; margin-right: 0.5rem;"></i>
                                Ligne de bus
                            </p>
                        </div>
                    `).join('');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('lignes-container').innerHTML = '<p style="color: #FF7A2A; text-align: center; grid-column: 1/-1;">Erreur lors du chargement des lignes</p>';
        });
});
</script>

<?php require_once '../includes/footer-unified.php'; ?>
