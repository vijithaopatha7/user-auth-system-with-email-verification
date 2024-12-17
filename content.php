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
    <div class="content">
        <h3>Dashboard Overview</h3>
        <p>
            Welcome to your dashboard! Here, you can find an overview of your recent activities, quick links to important
            features, and personalized recommendations.
        </p>

        <h3>Quick Links</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Explicabo quo, iusto ad odit repellat sunt dicta doloribus
            placeat blanditiis officiis sed numquam, mollitia in maiores
            repellendus optio eveniet quia! Atque pariatur laborum corporis
            ipsam voluptate dolore odit dolorum dignissimos nulla harum,
            repudiandae consequatur amet autem reiciendis mollitia facilis
            perspiciatis optio accusamus eligendi quos quis.
            Beatae necessitatibus dolores, quis aliquam fugit itaque,
            eveniet labore tenetur consequatur, aliquid cupiditate
            fugiat exercitationem iste rem distinctio expedita!
            Similique nihil illo corrupti pariatur ipsam cupiditate
            ipsa, velit rem temporibus deleniti incidunt aliquid ut
            fugiat eius, nisi vel eveniet! Perferendis
            ipsa fugit laudantium quia pariatur inventore!
        </p>

        <div class="cta">
            <a href="#">Get Started</a>
        </div>

    </div>
</body>

</html>