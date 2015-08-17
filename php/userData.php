<?php

require_once("../dhtmlxConnector_php/codebase/grid_connector.php");
require_once("config.php");

$grid = new GridConnector($conn, "MySQL");
$grid->dynamic_loading(100);
$grid->render_sql("SELECT * FROM users WHERE accountType = 'admin' OR accountType = 'standard'", "id", "firstName,lastName,email,accountType");

?>