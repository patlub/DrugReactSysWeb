<?php
session_start();

if($_SESSION['user_type'] == 'admin') {
    echo json_encode(true);
}
else {
    echo json_encode(false);
}
?>