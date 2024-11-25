<?php
session_start();


if (!isset($_SESSION['user'])) {
    header('Location: signin.html');
    exit();
}


$_SESSION['user']['name'] = $_POST['name'];
$_SESSION['user']['email'] = $_POST['email'];

header('Location: account.php');
exit();
?>
