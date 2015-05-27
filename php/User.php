<?php
class User{
    protected  $_user;
    protected  $_firstName;
    protected  $_lastName;
    protected  $_email;
    protected  $_password;
    protected  $_userType;

    public static function existingUser($email, $password){
        $instance  = new self();
        $instance->loadExistingUser($email,$password);
        return $instance;
    }
    /*
     * Helper method for new user(registering user)
     * @return Returns the new user object
     * */
    public static function newUser($firstName,$lastName,$email,$password,$userType){
        $instance  = new self();
        $instance->loadNewUser($firstName,$lastName,$email,$password,$userType);
        return $instance;
    }
    /*
     * @return returns the _firstName field
     * */
    public function getFirstName(){
        return $this->_firstName;
    }
    /*
     * @return returns the _lastName field
     * */
    public  function getLastName(){
        return $this->_lastName;
    }
    /*
     * @return returns the _email field
     * */
    public function getEmail(){
        return $this->_email;
    }
    /*
     * @return returns the _userType field
     * */
    public function getUserType(){
        return $this->_userType;
    }
    /*
     * @return returns the _user object
     * */
    public function getUser(){
        return $this->_user;
    }
    /* Sets the First name*/
    public function setFirstName($firstName){
        $this->_firstName = $firstName;
    }
    /*Sets the Last name*/
    public function setLastName($lastName){
        $this->_lastName = $lastName;
    }
    /*Sets the Email*/
    public function setEmail($email){
        $this->_email = $email;
    }
    /*Sets the Password*/
    public function setPassword($password){
        $this->_password = $password;
    }
    /*
     * Sets the fields for a new user who may be registering
     * @param $firstName is new user's first name
     * @param $lastName is  new user's last name
     * @param $userType is new user's account type(normal or admin)
     *
     * */
    private function loadNewUser($firstName,$lastName,$email,$password,$userType){
        $this->_email = $email;
        $this->_password = $password;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_userType = $userType;
    }
    private function loadExistingUser($email,$password){
        $this->_email = $email;
        $this->_password = $password;
    }
    /*
     * Logs in the user with right credentials
     *
     * @param $email is User's Email
     * @param $password is User's password
     *
     * @return boolean true for success and boolean false for failure
     *
     * */
    public function login(){
        $user = $this->checkCredentials();
        if($user) {
            $this->_user = $user;
            $_SESSION['user_id'] = $user['id'];
            return $user['id'];
        }
        return false;
    }
    /*
     * Logs out a user
     *
     * @return boolean true for success
     * */
    public  function logout(){
        session_destroy();
        return true;
    }
    /*
     * Inserts new user's values into the database
     *
     * @return Returns boolean(true on success and false on failure)
     * */
    public function register(){
        $dbh = $this->connectDB();
        $statementHandler = $dbh->prepare('INSERT INTO users VALUES firstName=?,lastName=?, email=?,password=?,accountType=?');
        $result = $statementHandler->execute(array($this->_firstName, $this->_lastName, $this->_email, $this->_password, $this->_userType));
        if($result)
            return true;
        return false;
    }
    /*
     * Checks for user validity from the database
     * @return returns the user Object
     *
     */
    protected function checkCredentials(){
        $dbh = $this->connectDB();
        $statementHandler = $dbh->prepare('SELECT * FROM users WHERE email=?');
        $statementHandler->execute(array($this->_email));
        if($statementHandler->rowCount > 0){
            $user = $statementHandler->fetch(PDO::FETCH_ASSOC);
            if($this->_password == $user['password']){
                return $user;
            }
        }
        return false;
    }
    /*
     * connects to the database using PDO
     * @return Returns a database handler to a new PDO object
     *
     */
    protected  function connectDB(){
        try{
            return new PDO("mysql:host=localhost;dbname=drugreaction","root","");
        }catch (PDOException $e){
            echo "Connection Error: ".$e->getMessage();
        }
    }
}
?>
