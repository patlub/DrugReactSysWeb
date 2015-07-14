<?php

require_once("../dhtmlxConnector_php/codebase/grid_connector.php");
require_once("config.php");

$grid = new GridConnector($conn, "MySQL");
$grid->render_sql("SELECT * FROM users WHERE accountType = 'admin'", "id", "firstName,lastName,email,password,accountType");

?>