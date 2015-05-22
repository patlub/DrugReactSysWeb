<?php
class User{
    protected  $_user;
    protected  $_firstName;
    protected  $_lastName;
    protected  $_email;
    protected  $_password;
    protected  $_userType;

    function _construct($email, $password){
        $this->_email = $email;
        $this->_password = $password;

    }

    public static function newUser(){
        $instance  = new self();
        return $instance;

    }
    public function getFirstName(){
        return $this->_firstName;
    }
    public  function getLastName(){
        return $this->_lastName;
    }
    public function getEmail(){
        return $this->_email;
    }
    public function getUserType(){
        return $this->_userType;
    }
    public function getUser(){
        return $this->_user;
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

    public  function logout(){

    }

    public function register(){

    }
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
    protected  function connectDB(){
        try{
            return new PDO("mysql:host=localhost;dbname=drugreaction","root","");
        }catch (PDOException $e){
            echo "Connection Error: ".$e->getMessage();
        }

    }
}

?>
