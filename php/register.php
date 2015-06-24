<?php
session_start();
require_once("User.php");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['passwordreg'];
$confirm = $_POST['confirm'];

$user = User::newUser($firstname,$lastname,$email,$password,"normal");
$result = $user->register();
if($result) {
    echo $_SESSION['user_email'];
}else {
    echo 'Error';
}
//echo "$result";
?>