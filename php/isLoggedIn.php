<?php
session_start();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    echo json_encode(true);
} else {
    echo json_encode(false);
}

?>