<?php
session_start();
require_once("User.php");

$loginEmail = $_SESSION['user_email'];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];

$user = User::existingUser($loginEmail,$currentPassword);
$result = $user->changePassword($newPassword);
if($result){
    echo true;
}else {
    echo false;
}
?>