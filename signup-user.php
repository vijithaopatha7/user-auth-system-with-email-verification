<?php
require_once 'controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="./css/signup-style.css">
    <link rel="stylesheet" href="./css/home-style.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">Logo</a>
        </div>
        <div class="nav-links">
            <a href="login-user.php" class="login">LOGIN</a>
            <a href="signup-user.php" class="signup">SIGN UP</a>
        </div>
    </nav>
    <!-- Display Errors -->
    <?php if (count($errors) > 0): ?>
        <div class="alert">
            <?php foreach ($errors as $showerror): ?>
                <p><?php echo $showerror; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <h2>Signup</h2>
        <form action="signup-user.php" method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>

            <button type="submit" name="signup">Signup</button>
        </form>

        <div class="links">
            <p>Already a member?</p><a href="login-user.php">Login here</a>
        </div>
    </div>
</body>

</html>