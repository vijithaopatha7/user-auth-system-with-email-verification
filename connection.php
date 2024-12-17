<?php
$con = mysqli_connect('localhost', 'root', '', 'userform');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
