<?php
session_start();
require_once 'connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = "";
$password = "";
$errors = array();


// If user clicks on the signup button
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors['password'] = "Passwords do not match";
    }

    // Check if email already exists
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);

    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "The email you entered already exists!";
    }

    // If no errors, proceed
    if (count($errors) === 0) {
        $code = rand(999999, 111111);
        $status = 'notverified';

        // Insert user data
        $insert_data = "INSERT INTO usertable (name, email, password, code, status) 
                        VALUES ('$name', '$email', '$password', '$code', '$status')";

        $data_check = mysqli_query($con, $insert_data);

        if ($data_check) {
            $_SESSION['name'] = $name;
            $mail = new PHPMailer(true);
            try {
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'vijithaopatha822@gmail.com';
                $mail->Password = 'jupn hzva vhkt xfzr';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('vijithaopatha822@gmail.com', 'Verification Service');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Email Verification Code";
                $mail->Body = "Your verification code is <strong>$code</strong>";

                $mail->send();

                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: user-otp.php');
                exit();
            } catch (Exception $e) {
                $errors['otp-error'] = "Failed to send the verification code! Error: " . $mail->ErrorInfo;
            }
        } else {
            $errors['db-error'] = "Failed to insert data into the database!";
        }
    }
}

// If user clicks on the login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if email exists
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $fetch_password = $row['password'];

        // Verify password
        if ($fetch_password == $password) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            header('location: content.php');
        } else {
            $errors['login-error'] = "Wrong password!";
        }
    } else {
        $errors['login-error'] = "Email does not exist!";
    }
}


// If user clicks on "Forgot Password"
if (isset($_POST['forgot-password'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check if email exists
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $code = rand(999999, 111111);

        // Update the reset code in the database
        $update_code = "UPDATE usertable SET code = '$code' WHERE email = '$email'";
        $update_res = mysqli_query($con, $update_code);

        if ($update_res) {
            $mail = new PHPMailer(true);
            try {
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'vijithaopatha822@gmail.com';
                $mail->Password = 'jupn hzva vhkt xfzr';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('vijithaopatha822@gmail.com', 'Password Reset');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Password Reset Code";
                $mail->Body = "Your password reset code is <strong>$code</strong>";

                $mail->send();
                $_SESSION['email'] = $email;
                $_SESSION['info'] = "A password reset code has been sent to your email - $email";
                header('location: reset_password.php');
                exit();
            } catch (Exception $e) {
                $errors['otp-error'] = "Failed to send the reset code! Error: " . $mail->ErrorInfo;
            }
        } else {
            $errors['db-error'] = "Failed to generate reset code!";
        }
    } else {
        $errors['email'] = "Email does not exist!";
    }
}

// If user clicks on "Reset Password" button
if (isset($_POST['reset-password'])) {
    $reset_code = mysqli_real_escape_string($con, $_POST['reset_code']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $errors['password'] = "Passwords do not match!";
    }

    // Verify the reset code
    $email = $_SESSION['email'];
    $check_code = "SELECT * FROM usertable WHERE email = '$email' AND code = '$reset_code'";
    $code_res = mysqli_query($con, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        // Update the password in the database
        $update_password = "UPDATE usertable SET password = '$new_password', code = 0 WHERE email = '$email'";
        $update_res = mysqli_query($con, $update_password);

        if ($update_res) {
            $_SESSION['info'] = "Your password has been successfully reset!";
            header('location: login-user.php');
            exit();
        } else {
            $errors['db-error'] = "Failed to reset the password!";
        }
    } else {
        $errors['reset-code'] = "Invalid reset code!";
    }
}
