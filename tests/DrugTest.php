<?php

require_once("C:\\xampp\\htdocs\\DrugreactSysWeb\\Php\\Drug.php");

class DrugTest extends PHPUnit_Framework_TestCase {
    private $newDrugReport;
    private $newDrugRequest;
    private $drugName = "Hedex";
    private $sickness = "malaria";
    private $sicknessPeriod = "1";
    private $dosage = "2 x 3";
    private $medPeriod = "1";
    private $signs = "vomiting";
    private $symptoms = "lack of appetite";
    private $userId = "1";


    public function setUp(){
        $this->newDrugReport = Drug::drugReport($this->drugName, $this->sickness, $this->dosage,
                                                    $this->medPeriod, $this->signs, $this->symptoms, $this->userId);

        $this->newDrugRequest = Drug::drugRequest($this->sickness, $this->signs, $this->symptoms,
                                                    $this->sicknessPeriod, $this->userId);
    }
    public function testCreationOfDrugObjectForReport(){
        $newDrugReport = $this->newDrugReport;
        $this->assertInstanceOf('Drug', $newDrugReport);
    }
    public function testCreationOfDrugObjectForRequest(){
        $newDrugRequest = $this->newDrugRequest;
        $this->assertInstanceOf('Drug', $newDrugRequest);
    }
    public function  testNewDrugReportFields()
    {
        $newDrugReport = $this->newDrugReport;
        $this->assertEquals($this->drugName,$newDrugReport->getDrugName());
        $this->assertEquals($this->sickness, $newDrugReport->getSickness());
        $this->assertEquals($this->dosage, $newDrugReport->getDosage());
        $this->assertEquals($this->medPeriod, $newDrugReport->getMedPeriod());
        $this->assertEquals($this->signs, $newDrugReport->getSigns());
        $this->assertEquals($this->symptoms, $newDrugReport->getSymptoms());
        $this->assertEquals($this->userId, $newDrugReport->getUserId());
    }
    public function  testNewDrugRequestFields()
    {
        $newDrugRequest = $this->newDrugRequest;
        $this->assertEquals($this->sickness,$newDrugRequest->getSickness());
        $this->assertEquals($this->signs, $newDrugRequest->getSigns());
        $this->assertEquals($this->symptoms, $newDrugRequest->getSymptoms());
        $this->assertEquals($this->sicknessPeriod, $newDrugRequest->getSicknessPeriod());
        $this->assertEquals($this->userId, $newDrugRequest->getUserId());
    }
    public function testDBConnection(){
        $newDrugReport = $this->newDrugReport;
        $DBHandler = $newDrugReport->connectDB();
        $this->assertInstanceOf('PDO', $DBHandler);
    }
    public function testReportDrugMethod(){
        $newDrugReport = $this->newDrugReport;
        $result = $newDrugReport->reportDrug();
        $this->assertTrue($result);
    }
    public function testRequestDrugMethod(){
        $newDrugRequest = $this->newDrugRequest;
        $result = $newDrugRequest->requestDrug();
        $this->assertTrue($result);
    }
}