<?php

session_start();

<<<<<<< Updated upstream
if (($_SESSION['role'] ?? null) !== 'fundraiser') {
=======
if (($_SESSION['role'] ?? null) !== 'fund_raiser') {
>>>>>>> Stashed changes
    header('Location: index.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? '');
<<<<<<< Updated upstream
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FundRaiser Dashboard</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 2rem; }
        a { color: #2563eb; }
    </style>
</head>
<body>
    <h1>Welcome, <?= $username ?></h1>
    <p>You are logged in as a FundRaiser.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
=======

include __DIR__ . '/boundary/views/dashboard_fr.view.php';
>>>>>>> Stashed changes
