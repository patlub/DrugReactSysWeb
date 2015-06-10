<?php

require_once('Drug.php');

$drugName = $_POST['enterDrugName'];
$sickness = $_POST['reportEnterSickness'];
$dosage = $_POST['dosage'];
$signs = $_POST['reportSigns'];
$symptoms = $_POST['reportSymptoms'];
$medPeriod = $_POST['reportMedicationPeriod'];

$drug = Drug::drugReport($drugName, $sickness, $dosage, $medPeriod, $signs, $symptoms, 2);
$result = $drug->reportDrug();
echo $result;

?>