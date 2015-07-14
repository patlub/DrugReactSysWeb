<?php
session_start();
require_once("User.php");

$loginEmail = $_SESSION['user_email'];
$password = $_POST['password'];

$user = User::existingUser($loginEmail,$password);
$result = $user->changePassword();
if($result){
    echo true;
}else {
    echo false;
}
?>