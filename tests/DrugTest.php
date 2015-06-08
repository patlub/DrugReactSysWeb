<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08/06/2015
 * Time: 13:16
 */
require_once("C:\\xampp\\htdocs\\DrugreactSysWeb\\Php\\Drug.php");


class DrugTest extends PHPUnit_Framework_TestCase {
    private $newDrugReport;
    private $newDrugRequest;
    private $drugName = "Hedex";
    private $sickness = "malaria";
    private $sicknessPeriod = "1";
    private $dosage = "2 x 3";
    private $medPeriod = "3";
    private $Signs = "vomiting";
    private $Symptoms = "lack of appetite";
    private $userId = "1";


    public function setUp(){
        $this->newDrugReport = Drug::drugReport($this->$drugName, $this->$sickness, $this->$dosage,
                                                    $this->$medPeriod, $this->$Signs, $this->$Symptoms, $this->$userId);

        $this->newDrugRequest = Drug::drugRequest($this->$sickness, $this->$signs, $this->$symptoms,
                                                    $this->$sicknessPeriod, $this->$userId);
    }
    public function  testNewDrugReportObjectCreation()
    {
        $newDrugReport = $this->newDrugReport;
        assertTrue($newDrugReport);
    }

}
 