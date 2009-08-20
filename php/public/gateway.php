<?php


ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . "../libs");

require_once('Zend/Amf/Server.php');
require_once('redbean/oodb.php');



// INITIALIZE REDBEAN
    $hostname = "localhost"; //the host where we should connect to...
    $databasename = "flex_deathmatch"; //the name of the database we should select
    $username = "root"; //the user for the selected database
    $password = "root"; //the password, if any, to sign in
    $debugmode = false; //do you want to see the queries RedBean performs?
    $freeze = false;
    $engine = "innodb";

    RedBean_Setup::kickstart("mysql:host=$hostname;dbname=$databasename", $username, $password, $freeze, $engine, $debugmode);




// START SESSION 
    session_start();
    




// CREATE MODELS
    R::gen("Twaat,User");
    
    class Fault
    {
        public $error;
        
        public function Fault($error)
        {
            $this->error = $error;
        }
    }
    
    
    
    
// SERVICES 

    class TwaatService
    {
        public function follow($user)
        {
            
        }
        
        public function 
    }
    
    class UserService
    {
        public function register($user)
        {
            $user->save();
            return true;
        }
        
        public function login($user)
        {
            $params = array("username" => $user->username, "password" => $user->password);
            $user = User::where("username = {username} AND password = {password}",$params)->current();
            
            if (isset($user))
                return $user;
            else
                return new Fault("badLogin");
        }
    }








    

// START SERVER // 
$server = new Zend_Amf_Server();
$server->setProduction(false);

// Service Mapping // 
$server->setClass('AccountService','AccountService');

// Class Mapping
$server->setClassMap('Twaat','Twaat');
$server->setClassMap('User','User');

echo($server->handle());
