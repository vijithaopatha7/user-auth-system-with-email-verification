<?php
session_start();
require_once 'connection.php';

$errors = array();

// Check if the OTP form is submitted
if (isset($_POST['check'])) {
    $otp = mysqli_real_escape_string($con, $_POST['otp']);
    $email = $_SESSION['email'];

    // Check if the OTP matches
    $check_code = "SELECT * FROM usertable WHERE email = '$email' AND code = '$otp'";
    $code_res = mysqli_query($con, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        // Update the user's status to 'verified'
        $update_status = "UPDATE usertable SET status = 'verified', code = 0 WHERE email = '$email'";
        $update_res = mysqli_query($con, $update_status);

        if ($update_res) {
            $_SESSION['info'] = "Your email has been successfully verified!";
            header('location: content.php');
            exit();
        } else {
            $errors['db-error'] = "Failed to update the verification status!";
        }
    } else {
        $errors['otp-error'] = "Invalid verification code!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="./css/otp-style.css">
</head>

<body>
    <div class="form-container">
        <h2>Verify Your Email</h2>
        <p>Please enter the verification code we sent to your email.</p>

        <!-- Display Errors -->
        <?php if (count($errors) > 0): ?>
            <div class="alert">
                <?php foreach ($errors as $showerror): ?>
                    <p><?php echo $showerror; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="user-otp.php" method="POST">
            <label for="otp">Verification Code :</label>
            <input type="number" id="otp" name="otp" placeholder="Enter the code" required>
            <button type="submit" name="check">Verify</button>
        </form>
    </div>
</body>

</html>