<?php

class Drug {
    private $_drugName;
    private $_sickness;
    private $_dosage;
    private $_medPeriod;
    private $_signs;
    private $_symptoms;
    private $_userId;
    private $_sicknessPeriod;

    public function getDrugName(){
        return $this->_drugName;
    }
    public function setDrugName($drugName){
        $this->_drugName = $drugName;
    }
    public function getSickness(){
        return $this->_sickness;
    }
    public function setSickness($sickness){
        $this->_sickness = $sickness;
    }
    public function getDosage(){
        return $this->_dosage;
    }
    public function setDosage($dosage){
        $this->_dosage = $dosage;
    }
    public function getMedPeriod(){
        return $this->_medPeriod;
    }
    public function setMedPeriod($medPeriod){
        $this->_medPeriod = $medPeriod;
    }
    public function getSigns(){
        return $this->_signs;
    }
    public function setSigns($signs){
        $this->_signs = $signs;
    }
    public function getSymptoms(){
        return $this->_symptoms;
    }
    public function setSymptoms($symptoms){
        $this->_symptoms = $symptoms;
    }
    public function getUserId(){
        return $this->_userId;
    }
    public function setUserId($userId){
        $this->_userId = $userId;
    }
    public function getSicknessPeriod(){
        return $this->_sicknessPeriod;

    }
    public function setSicknessPeriod($sicknessPeriod){
        $this->_sicknessPeriod = $sicknessPeriod;

    }
    public static function drugReport($drugName, $sickness, $dosage, $medPeriod, $Signs, $Symptoms, $userId){
        $instance  = new self();
        $instance->loadDrugReport($drugName, $sickness, $dosage, $medPeriod, $Signs, $Symptoms, $userId);
        return $instance;
    }
    /*
     * Helper method for new user(registering user)
     * @return Returns the new user object
     * */
    public static function drugRequest($sickness, $signs, $symptoms, $sicknessPeriod, $userId){
        $instance  = new self();
        $instance->loadDrugRequest($sickness, $signs, $symptoms, $sicknessPeriod, $userId);
        return $instance;
    }

    public function loadDrugReport($drugName, $sickness, $dosage, $medPeriod, $signs, $symptoms, $userId){
        $this->_drugName = $drugName;
        $this->_sickness = $sickness;
        $this->_dosage = $dosage;
        $this->_medPeriod = $medPeriod;
        $this->_signs = $signs;
        $this->_symptoms = $symptoms;
        $this->_userId = $userId;
    }

    public function loadDrugRequest($sickness, $signs, $symptoms, $sicknessPeriod, $userId){
        $this->_sickness = $sickness;
        $this->_signs = $signs;
        $this->_symptoms = $symptoms;
        $this->_sicknessPeriod = $sicknessPeriod;
        $this->_userId = $userId;
    }


    public function requestDrug(){

    }

    public function reportDrug(){

    }

    public  function connectDB()
    {
        try {
            return new PDO("mysql:host=localhost;dbname=drugreaction", "root", "");
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
} 