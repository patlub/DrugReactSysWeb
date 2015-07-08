<?php
session_start();
require_once("User.php");

$loginEmail = $_POST['loginEmail'];
$password = $_POST['password'];

$user = User::existingUser($loginEmail,$password);
$result = $user->login();
 if($result){
     echo true;
}else {
     echo false;
 }
?>