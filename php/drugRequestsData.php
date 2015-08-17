<?php

require_once("../dhtmlxConnector_php/codebase/grid_connector.php");
require_once("config.php");

$grid = new GridConnector($conn, "MySQL");
$grid->dynamic_loading(100);
$grid->render_table(
    "drugrequests","id","reqSickness,reqSigns,reqSymptoms,sicknessPeriod,status,answer,count"
);

?>