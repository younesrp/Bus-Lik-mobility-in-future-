<?php
// Handler pour forgot password depuis public/
session_start();
require_once '../../config/Db.php';
require_once '../../app/models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email)) {
        header("Location: ../forgot.php?error=" . urlencode("Email requis"));
        exit;
    }

    try {
        $userModel = new User();
        $user = $userModel->getByEmail($email);

        if ($user) {
            // Pour l'instant, on simule l'envoi d'email
            // TODO: Implémenter l'envoi d'email de réinitialisation
            header("Location: ../forgot.php?success=" . urlencode("Un email de réinitialisation a été envoyé à votre adresse"));
            exit;
        } else {
            header("Location: ../forgot.php?error=" . urlencode("Aucun compte trouvé avec cet email"));
            exit;
        }
    } catch (Exception $e) {
        header("Location: ../forgot.php?error=" . urlencode("Erreur: " . $e->getMessage()));
        exit;
    }
} else {
    header("Location: ../forgot.php");
    exit;
}
?>
