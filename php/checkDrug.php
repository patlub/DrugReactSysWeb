<?php
require_once('config.php');
sleep(4);

$drugName = $_POST['selectDrug'];

$result = mysql_query("SELECT * FROM drugs WHERE drugName = '$drugName'");
$rows = array();

while($row = mysql_fetch_assoc($result)){
    $rows[] = $row;
}
echo json_encode($rows);
?>