<?php

require_once("../dhtmlxConnector_php/codebase/grid_connector.php");

$conn = mysql_connect("localhost","root","");
mysql_select_db("drugreaction");

$grid = new GridConnector($conn, "MySQL");
$grid->render_table("drugs","id","drugName,sickness,sideSigns,sideSymptoms,dosage");

?>