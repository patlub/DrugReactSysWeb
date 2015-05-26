<?php

//function __autoload($class_name) {
//    require_once("class.". $class_name. ".php");
//}
require_once("C:\\xampp\\htdocs\\DrugreactSysWeb\\Php\\User.php");

class UserTest extends PHPUnit_Framework_TestCase {
    private $user;
    private $existingUser;
    private $newUser;
    private $email = "patricklu2010@gmail.com";
    private $password = "qwerty";
    private $firstname = "Patrick";
    private $lastname = "Luboobi";


    public function setUp(){
    //    $this->user - new User();
        $this->existingUser = User::existingUser($this->email, $this->password);
        $this->newUser = User::newUser($this->firstname,$this->lastname,$this->email,$this->password,"normal");
    }

//    public function testExistingUserCreation(){
//        $user = $this->existingUser;
//        $this->assertInstanceOf($user,$this->user);
//    }
    public function testExistingUserEmail()
    {
        $user = $this->existingUser;
        $this->assertEquals($this->email,$user->getEmail());
    }
}
?>