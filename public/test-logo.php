<?php
// Test pour vérifier le chemin du logo
$scriptPath = $_SERVER['PHP_SELF'];
echo "Script Path: " . $scriptPath . "<br>";
echo "Is in public/: " . (strpos($scriptPath, '/public/') !== false ? 'YES' : 'NO') . "<br>";

if (strpos($scriptPath, '/public/') !== false) {
    $logoPath = '../assets/images/image1.png';
} elseif (strpos($scriptPath, '/admin/') !== false || strpos($scriptPath, '/api/') !== false) {
    $logoPath = '../assets/images/image1.png';
} else {
    $logoPath = 'assets/images/image1.png';
}

echo "Logo Path: " . $logoPath . "<br>";
echo "File exists: " . (file_exists(__DIR__ . '/../' . $logoPath) ? 'YES' : 'NO') . "<br>";
echo "Full path: " . __DIR__ . '/../' . $logoPath . "<br>";
?>
<img src="<?php echo $logoPath; ?>" alt="Test Logo" style="height: 100px; border: 2px solid red;">
