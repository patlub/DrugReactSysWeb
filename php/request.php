<?php

require_once('Drug.php');

$sickness = $_POST['enterSickness'];
$signs = $_POST['requestEnterSigns'];
$symptoms = $_POST['requestEnterSymptoms'];
$sicknessPeriod = $_POST['sicknessPeriod'];

$drug = Drug::drugRequest($sickness, $signs, $symptoms, $sicknessPeriod, 3);
$result = $drug->requestDrug();
echo $result;

?>