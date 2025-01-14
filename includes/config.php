<?php
$host = 'localhost';  // Database host
$dbname = 'game_management';  // Database naam
$username = 'root';  // Database gebruiker
$password = '';  // Database wachtwoord

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}
?>
