<?php
require_once 'controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="./css/login-style.css">
</head>

<body>
    <div class="form-container">
        <h2>Reset Password</h2>
        <p id="id_2">Enter the reset code and your new password.</p>

        <!-- Display Errors -->
        <?php if (count($errors) > 0): ?>
            <div class="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="reset_password.php" method="POST">
            <label for="reset-code">Reset Code : </label>
            <input type="number" id="reset-code" name="reset_code" placeholder="Enter the code" required>

            <label for="new-password">New Password : </label>
            <input type="password" id="new-password" name="new_password" placeholder="Enter your new password" required>

            <label for="confirm-password">Confirm Password : </label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your new password" required>

            <button type="submit" name="reset-password">Reset Password</button>
        </form>
    </div>
</body>

</html>