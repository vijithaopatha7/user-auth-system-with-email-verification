<?php
require_once 'controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./css/login-style.css">
</head>

<body>
    <div class="form-container">
        <h2>Forgot Password</h2>
        <p id="id_1">Enter your email to receive a password reset code.</p>

        <!-- Display Errors -->
        <?php if (count($errors) > 0): ?>
            <div class="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="forgot_password.php" method="POST">
            <label for="email">Email : </label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <button type="submit" name="forgot-password">Send Code</button>
        </form>
    </div>
</body>

</html>