<?php

require_once("../dhtmlxConnector_php/codebase/grid_connector.php");
require_once("config.php");

$grid = new GridConnector($conn, "MySQL");
$grid->render_table(
    "drugs","id","drugName,sickness,sideSigns,sideSymptoms,dosage"
);

?>