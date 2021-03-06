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

    /*
     * setters and getters */
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
    /*
     * Helper function for new drug report
     * @return instance of new drug report object
     *
     * */
    public static function drugReport($drugName, $sickness, $dosage, $medPeriod, $Signs, $Symptoms, $userId){
        $instance  = new self();
        $instance->loadDrugReport($drugName, $sickness, $dosage, $medPeriod, $Signs, $Symptoms, $userId);
        return $instance;
    }
    /*
     * Helper method for new user(registering user)
     * @return Returns the new drug request object
     * */
    public static function drugRequest($sickness, $signs, $symptoms, $sicknessPeriod, $userId){
        $instance  = new self();
        $instance->loadDrugRequest($sickness, $signs, $symptoms, $sicknessPeriod, $userId);
        return $instance;
    }

    /*
     * Sets the fields for the new drug report
     * */
    public function loadDrugReport($drugName, $sickness, $dosage, $medPeriod, $signs, $symptoms, $userId){
        $this->_drugName = $drugName;
        $this->_sickness = $sickness;
        $this->_dosage = $dosage;
        $this->_medPeriod = $medPeriod;
        $this->_signs = $signs;
        $this->_symptoms = $symptoms;
        $this->_userId = $userId;
    }
    /*
     * Sets the fields for the new drug request
     * */
    public function loadDrugRequest($sickness, $signs, $symptoms, $sicknessPeriod, $userId){
        $this->_sickness = $sickness;
        $this->_signs = $signs;
        $this->_symptoms = $symptoms;
        $this->_sicknessPeriod = $sicknessPeriod;
        $this->_userId = $userId;
    }
    /*
     * Stores the new drug report object to the database
     * @return boolean true on success else failure
     * */
    public function reportDrug(){
        $dbh = $this->connectDB();
        $statementHandler = $dbh->prepare('INSERT INTO drugreports VALUES (:id, :drugName, :sickness, :dosage, :signs,
                                                                          :symptoms, :medPeriod, :userId, :date, :status, :answer, :count )');
        $id = '';
        $date = date('Y-m-d');
        $status = 'pending';
        $answer = '';
        $count = 1;
        $statementHandler->bindParam(':id', $id);
        $statementHandler->bindParam(':drugName', $this->_drugName);
        $statementHandler->bindParam(':sickness', $this->_sickness);
        $statementHandler->bindParam(':dosage', $this->_dosage);
        $statementHandler->bindParam(':signs', $this->_signs);
        $statementHandler->bindParam(':symptoms', $this->_symptoms);
        $statementHandler->bindParam(':medPeriod', $this->_medPeriod);
        $statementHandler->bindParam(':userId', $this->_userId);
        $statementHandler->bindParam(':date', $date);
        $statementHandler->bindParam(':status', $status);
        $statementHandler->bindParam(':answer', $answer);
        $statementHandler->bindParam(':count', $count);
        $result = $statementHandler->execute();
        if($result){
            return $result;
        }
        return false;
    }
    /*
     * Stores the new drug request to the database
     * @return boolean true on success else failure
     * */
    public function requestDrug(){
        $dbh = $this->connectDB();
        $statementHandler = $dbh->prepare('INSERT INTO drugrequests VALUES (:id, :sickness, :signs, :symptoms,
                                                            :sicknessPeriod, :date, :userId, :status, :answer, :count)');
        $id = '';
        $date = date('Y-m-d');
        $status = 'pending';
        $answer = '';
        $count = 1;
        $statementHandler->bindParam(':id', $id);
        $statementHandler->bindParam(':sickness', $this->_sickness);
        $statementHandler->bindParam(':signs', $this->_signs);
        $statementHandler->bindParam(':symptoms', $this->_symptoms);
        $statementHandler->bindParam(':sicknessPeriod', $this->_sicknessPeriod);
        $statementHandler->bindParam(':date', $date);
        $statementHandler->bindParam(':userId', $this->_userId);
        $statementHandler->bindParam(':status', $status);
        $statementHandler->bindParam(':answer', $answer);
        $statementHandler->bindParam(':count', $count);
        $result = $statementHandler->execute();
        if($result){
            return $result;
        }
        return false;
    }
    /*PDO database connection*/
    public  function connectDB()
    {
        try {
            return new PDO("mysql:host=localhost;dbname=drugreaction", "root", "");
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
} 