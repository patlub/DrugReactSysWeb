<?php
class User{
    protected  $_user;
    protected  $_firstName;
    protected  $_lastName;
    protected  $_email;
    protected  $_password;
    protected  $_userType;

    /*
     * Helper method for existing user(registering user)
     * @return Returns the existing user object
     *
     * */
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
    public function setUserType($userType){
        $this->_userType = $userType;
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
    /*
     * Sets the fields of an existing user in the Database who may be logging in
     * @param $email, Existing User's email
     * @param $password, Existing User's password
     *
     * */
    private function loadExistingUser($email,$password){
        $this->_email = $email;
        $this->_password = $password;
    }
    /*
     * Logs in the user with right credentials
     *
     * @return boolean true for success and boolean false for failure
     *
     * */
    public function login(){
        $user = $this->checkCredentials();
        if($user) {
            $this->_user = $user;
            $_SESSION['user'] = $user;
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $this->_email;
            $_SESSION['user_type']  = $user['accountType'];
            $_SESSION['password'] = $user['password'];
            return $user['id'];
        }
        return false;
    }
    /*
     * Checks for user validity from the database
     * @return returns the user Object
     *
     */
    protected function checkCredentials(){
        $dbh = $this->connectDB();
        $statementHandler = $dbh->prepare('SELECT * FROM users WHERE email = :email');
        $statementHandler->bindParam(':email',$this->_email,PDO::PARAM_STR);
        $statementHandler->execute();
        if($statementHandler->rowCount() > 0){
            $user = $statementHandler->fetch(PDO::FETCH_ASSOC);
            if($this->_password == $user['password']){
                return $user;
            }
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
        $statementHandler = $dbh->prepare('INSERT INTO users (id,firstName,lastName,email,password,accountType) VALUES
                                                              (:id, :firstname, :lastname, :email, :password, :accounttype)');
        $id = '';
        $statementHandler->bindParam(':id',$id);
        $statementHandler->bindParam(':firstname',$this->_firstName);
        $statementHandler->bindParam(':lastname',$this->_lastName);
        $statementHandler->bindParam(':email',$this->_email);
        $statementHandler->bindParam(':password',$this->_password);
        $statementHandler->bindParam(':accounttype',$this->_userType);
        $result = $statementHandler->execute();
        if($result) {
            $statementHandler = $dbh->prepare('SELECT LAST_INSERT_ID()');
            $statementHandler->execute();
            $LastRow = $statementHandler->fetch(PDO::FETCH_ASSOC);

            $_SESSION['loggedIn'] = true;
            $_SESSION['user_id'] = $LastRow['LAST_INSERT_ID()'];
            $_SESSION['user_email'] = $this->_email;

            return $result;
        }
        return false;
    }

    public function changePassword($newPassword){
        if($this->_password == $_SESSION['password']){
            $dbh = $this->connectDB();
            $statementHandler = $dbh->prepare('UPDATE users SET password = :password WHERE id = :id');
            $statementHandler->bindParam(':id',$_SESSION['user_id'],PDO::PARAM_INT);
            $statementHandler->bindParam(':password',$newPassword,PDO::PARAM_STR);
            $result = $statementHandler->execute();
            if($result){
                $_SESSION['password'] = $newPassword;
                return $result;
            }
            return false;
        }
        return false;
    }
    /*
     * connects to the database using PDO
     * @return Returns a database handler to a new PDO object
     *
     */
    public  function connectDB(){
        try{
            return new PDO("mysql:host=localhost;dbname=drugreaction","root","");
        }catch (PDOException $e){
            echo "Connection Error: ".$e->getMessage();
        }
    }
}
?>
