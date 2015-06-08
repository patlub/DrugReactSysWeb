<?php

require_once("C:\\xampp\\htdocs\\DrugreactSysWeb\\Php\\User.php");

class UserTest extends PHPUnit_Framework_TestCase{
    private $existingUser;
    private $newUser;
    private $email = "patricklu2010@gmail.com";
    private $password = "qwerty";
    private $firstname = "Patrick";
    private $lastname = "Luboobi";
    private $userType = "normal";


    public function setUp(){
        $this->existingUser = User::existingUser($this->email, $this->password);
        $this->newUser = User::newUser($this->firstname,$this->lastname,$this->email,$this->password,$this->userType);
    }
    public function testExistingUserEmail()
    {
        $user = $this->existingUser;
        $this->assertEquals($this->email,$user->getEmail());
    }
    public function testNewUserFields(){
        $user = $this->newUser;
        $this->assertEquals($this->firstname, $user->getFirstName());
        $this->assertEquals($this->lastname, $user->getLastName());
        $this->assertEquals($this->email, $user->getEmail());
        $this->assertEquals($this->userType, $user->getUserType());
    }
    public function testSetterMethods(){
        $user = $this->newUser;
        $user->setFirstName("Perfect");
        $this->assertEquals("Perfect",$user->getFirstName());
        $user->setLastName("Grace");
        $this->assertEquals("Grace", $user->getLastname());
        $user->setEmail("patrickmas@gmail.com");
        $this->assertEquals("patrickmas@gmail.com", $user->getEmail());
        $user->setUserType("admin");
        $this->assertEquals("admin", $user->getUserType());
    }
    public function testConnectDB(){
        $user = $this->newUser;
        $conn = $user->connectDB();
        $pdo = new PDO("mysql:host=localhost;dbname=drugreaction","root","");
        $this->assertEquals($pdo,$conn);
    }
    public function testUserRegistration(){
        $user = $this->newUser;
        $result = $user->register();
        $this->assertTrue($result);
    }
    public function testUserLogin(){
        $user = $this->existingUser;
        $user->setEmail("patricklu2010@gmail.com");
        $user->setPassword("qwerty");
        $result = $user->login();
        $this->assertEquals("1",$result);
    }
}
?>