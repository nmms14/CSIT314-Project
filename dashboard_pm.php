<?php

session_start();

if (($_SESSION['role'] ?? null) !== 'platform_manager') {
    header('Location: index.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Platform Manager Dashboard</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 2rem; }
        a { color: #2563eb; }
    </style>
</head>
<body>
    <h1>Welcome, <?= $username ?></h1>
    <p>You are logged in as a Platform Manager.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
