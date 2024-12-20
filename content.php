<?php
require_once 'controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/home-style.css">
    <link rel="stylesheet" href="./css/content-style.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">Logo</a>
        </div>
        <div class="nav-links">
            <a href="logout-user.php" class="LOGOUT">LOGOUT</a>
        </div>
    </nav>

    <div class="welcome">
        <h2>Welcome <?php echo htmlspecialchars($_SESSION['name']); ?>...!!!</h2>
    </div>
    <div>

    </div>
</body>

</html>