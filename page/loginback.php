<?php
session_start();
require_once('Connection.php'); ?>
<?php


if (isset($_POST['submit'])) {
    // print_r($_POST);
    $errors = array();
    if (!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1) {
        $errors[] = 'Username is Missing / Invalid';
    }
    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
        $errors[] = 'password is Missing / Invalid';
    }
    if (empty($errors)) {

        $Email = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM `user_reg` WHERE `Email`='$Email'  AND `password`='$password' LIMIT 1";

        $result_set = mysqli_query($conn, $query);
        $datas = mysqli_fetch_assoc($result_set);

        if ($result_set) {
            if (mysqli_num_rows($result_set) > 0) {
                $_SESSION["auth"] = true;
                $_SESSION['id'] = $datas['id'];
                header('LOCATION:admin.php');
            } 
        else {
                $errors[] = 'Invalid Username / Password';
            }
        } else {
            $errors[] = 'Database query failed';
        }
    }
}


?>