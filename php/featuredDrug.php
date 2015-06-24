<?php
require_once('config.php');

$offset_result = mysql_query(" SELECT FLOOR(RAND() * COUNT(*)) AS offset FROM drugs");
$offset_row = mysql_fetch_object($offset_result);
$offset = $offset_row->offset;
$result = mysql_query(" SELECT * FROM drugs LIMIT $offset, 1");
$rows = array();

while($row = mysql_fetch_assoc($result)){
    $rows[] = $row;
}
echo json_encode($rows);
?>