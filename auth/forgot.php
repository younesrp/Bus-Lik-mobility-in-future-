<?php
require_once '../config/Db.php';
require_once '../app/models/User.php';

// Crée la connexion PDO
$db = (new Db())->getConnection();
$userModel = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    $user = $userModel->getByEmail($email);

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $userModel->setResetToken($user['id'], $token);

        $resetLink = "http://yourdomain.com/auth/reset-password.php?token=$token";
        mail($email, "Réinitialisation de mot de passe", "Cliquez ici pour réinitialiser votre mot de passe: $resetLink");

        $message = "Un email de réinitialisation a été envoyé.";
    } else {
        $error = "Email non trouvé.";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Votre email" required>
    <button type="submit">Réinitialiser le mot de passe</button>
</form>

<?php
if(isset($error)) echo "<p>$error</p>";
if(isset($message)) echo "<p>$message</p>";
?>
