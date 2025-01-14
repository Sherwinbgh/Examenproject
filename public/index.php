<?php
// Start sessie om te controleren of de gebruiker is ingelogd
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php'); // Gebruik relatief pad naar login.php in de views map

    exit();
}

// Verbind met de database
require_once '../includes/config.php'; // Gebruik relatieve pad naar config.php

// Verkrijg alle games uit de database
$sql = "SELECT games.id, games.title, games.description, categories.category_name 
        FROM games
        LEFT JOIN categories ON games.category_id = categories.id";
$result = $pdo->query($sql);

// Haal gebruikersinformatie op (voor weergave van de naam bij logout)
$user_id = $_SESSION['user_id'];
$user_query = "SELECT username FROM users WHERE id = ?";
$stmt = $pdo->prepare($user_query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Logout functionaliteit
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ../views/login.php'); // Gebruik relatief pad naar login.php in de views map


    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigatiebalk -->
    <nav class="bg-blue-600 p-4 flex justify-between items-center">
        <span class="text-white text-xl font-bold">Welcome, <?php echo htmlspecialchars($user['username']); ?>!</span>
        <a href="index.php?logout=true" class="text-white">Logout</a>
    </nav>

    <!-- Games Overzicht -->
    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-semibold mb-6">Available Games</h2>

        <!-- Lijst met games -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if ($result->rowCount() > 0): ?>
                <?php while ($game = $result->fetch()): ?>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($game['title']); ?></h3>
                        <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($game['description']); ?></p>
                        <span class="text-blue-500"><?php echo htmlspecialchars($game['category_name']); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-red-500">No games found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
