<?php
session_start();
require_once("../dhtmlxConnector_php/codebase/grid_connector.php");
require_once("config.php");

$grid = new GridConnector($conn, "MySQL");
$grid->render_sql("SELECT * FROM users WHERE id = '".$_SESSION['user_id']."'", "id", "firstName,lastName,email");

?>