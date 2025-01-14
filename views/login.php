<?php
session_start();
require_once '../includes/User.php';

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (User::login($username, $password)) {
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/Blue-Wallpaper-For-Background-6.jpg'); /* Zorg dat dit pad klopt */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .glass {
            background: rgba(255, 255, 255, 0.2); /* Lichte transparantie */
            backdrop-filter: blur(10px); /* Wazige achtergrond */
            -webkit-backdrop-filter: blur(10px); /* Wazige achtergrond voor Safari */
            border: 1px solid rgba(255, 255, 255, 0.3); /* Dunne witte rand */
            border-radius: 15px; /* Ronde hoeken */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Subtiele schaduw */
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen">
<div class="glass w-full max-w-lg h-110 p-12">
        <h2 class="text-2xl font-bold text-center mb-6 text-white">Login</h2>
        <form method="POST" action="login.php">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                <input type="text" name="username" id="username" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md">Login</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-200">
            Don't have an account? <a href="register.php" class="text-blue-400">Register here</a>
        </p>
    </d>
</body>
</html>