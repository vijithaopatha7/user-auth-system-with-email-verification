<?php
require_once 'controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./css/login-style.css">
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
    <div class="form-container">
        <h2>Login</h2>

        <form action="login-user.php" method="POST">
            <?php if (count($errors) > 0): ?>
                <div class="alert">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" name="login">Login</button>
        </form>

        <div class="links">
            <a href="forgot_password.php">Forgot Password?</a>
            <a href="signup-user.php">I am not yet a member</a>
        </div>
    </div>
</body>

</html>