<?php
session_start();
require_once '../config/Db.php';
require_once '../app/models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $userModel = new User();
    if ($userModel->getByEmail($email)) {
        $error = "Cet email est déjà utilisé.";
    } else {
        $userModel->create($name, $email, $hashedPassword);
        $_SESSION['user_id'] = $userModel->getByEmail($email)['id'];
        $_SESSION['user_name'] = $name;
        header("Location: ../public/dashboard.php");
        exit;
    }
}
?>

<!-- Formulaire HTML -->
<form method="POST">
    <input type="text" name="name" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>
<?php if (isset($error))
    echo "<p>$error</p>"; ?>