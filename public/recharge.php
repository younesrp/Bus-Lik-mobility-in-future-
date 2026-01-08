<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = "Recharger";
require_once '../includes/header-unified.php';

require_once '../config/Db.php';
$db = Db::connection();

// Get current balance
$stmt = $db->prepare("SELECT balance FROM wallets WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$wallet = $stmt->fetch(PDO::FETCH_ASSOC);
$balance = $wallet['balance'] ?? 0.00;
?>

<div style="min-height: 80vh; padding: 4rem 2rem; background: #111632;">
    <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center;">Recharger mon compte</h1>
        
        <div style="background: rgba(255,255,255,0.1); padding: 2.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.2); margin-bottom: 2rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 0.5rem;">Solde actuel</p>
                <p style="color: #FFFFFF; font-size: 2.5rem; font-weight: 700; margin: 0;"><?php echo number_format($balance, 2); ?> DH</p>
            </div>
            
            <form id="recharge-form" style="display: grid; gap: 1.5rem;">
                <div>
                    <label style="color: rgba(255,255,255,0.9); font-size: 0.9rem; display: block; margin-bottom: 0.5rem; font-weight: 500;">Montant (DH)</label>
                    <input type="number" id="amount" min="10" step="10" required 
                           style="width: 100%; padding: 1rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.1); color: #FFFFFF; font-size: 1.1rem;"
                           placeholder="Montant minimum: 10 DH">
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem;">
                    <button type="button" class="amount-btn" data-amount="20" style="background: rgba(255,255,255,0.1); color: #FFFFFF; padding: 0.75rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer; font-weight: 600;">20 DH</button>
                    <button type="button" class="amount-btn" data-amount="50" style="background: rgba(255,255,255,0.1); color: #FFFFFF; padding: 0.75rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer; font-weight: 600;">50 DH</button>
                    <button type="button" class="amount-btn" data-amount="100" style="background: rgba(255,255,255,0.1); color: #FFFFFF; padding: 0.75rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer; font-weight: 600;">100 DH</button>
                    <button type="button" class="amount-btn" data-amount="200" style="background: rgba(255,255,255,0.1); color: #FFFFFF; padding: 0.75rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); cursor: pointer; font-weight: 600;">200 DH</button>
                </div>
                
                <button type="submit" style="background: #FF7A2A; color: #FFFFFF; padding: 1rem 2rem; border-radius: 8px; border: none; font-weight: 600; font-size: 1rem; cursor: pointer;">
                    Recharger
                </button>
            </form>
            
            <div id="recharge-result" style="margin-top: 1.5rem; display: none;"></div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.amount-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('amount').value = this.dataset.amount;
    });
});

document.getElementById('recharge-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const amount = parseFloat(document.getElementById('amount').value);
    
    if (amount < 10) {
        alert('Le montant minimum est de 10 DH');
        return;
    }
    
    fetch('../api/recharge.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({amount: amount})
    })
    .then(response => response.json())
    .then(data => {
        const resultDiv = document.getElementById('recharge-result');
        resultDiv.style.display = 'block';
        if (data.status === 'success') {
            resultDiv.innerHTML = `<div style="background: rgba(72,187,120,0.2); color: #48BB78; padding: 1rem; border-radius: 8px; text-align: center;">
                ✅ ${data.message}<br>
                <strong>Nouveau solde: ${data.new_balance.toFixed(2)} DH</strong>
            </div>`;
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            resultDiv.innerHTML = `<div style="background: rgba(245,101,101,0.2); color: #F56565; padding: 1rem; border-radius: 8px; text-align: center;">
                ⚠️ ${data.message}
            </div>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la recharge');
    });
});
</script>

<?php require_once '../includes/footer-unified.php'; ?>
