<?php

require_once("../dhtmlxConnector_php/codebase/grid_connector.php");
require_once("config.php");

$grid = new GridConnector($conn, "MySQL");
$grid->dynamic_loading(100);
$grid->render_table(
    "drugreports","id","repDrugName,repSickness,repDosage,repSideSigns,repSideSymptoms,repMedPeriod,status,answer,count"
);

?>