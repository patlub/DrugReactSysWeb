<?php
session_start();

require_once('config.php');

$userSession = $_SESSION['user_id'];

$query = mysql_query("SELECT * FROM drugrequests WHERE id='$userSession'");
$rows = array();
while($row = mysql_fetch_assoc($query)) {
    $rows[] = $row;
}
echo json_encode($rows);
?>