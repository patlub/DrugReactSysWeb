<?php
require_once ("config.php");

$query = mysql_query("SELECT * FROM drugs");
$rows = array();
while($row = mysql_fetch_assoc($query)) {
    $rows[] = $row;
}
echo json_encode($rows);
?>