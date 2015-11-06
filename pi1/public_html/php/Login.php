<?php

/**
 * Description of Login
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("Admin.php");
include_once("Owner.php");
include_once("Recipient.php");

class Login 
{
    private $identification;
    private $password;
    private $type;
    private static $dataController;        
    
    public function __construct($identification, $password) 
    {
        $this->identification = $identification;
        $this->password = $password;
    }
    
    public function identification($identification = null)
    {
        if ($identification == null)
            return $this->identification;
        else
            $this->identification = $identification;
    }
    
    public function password($password = null)
    {
        if ($password == null)
            return $this->password;
        else
            $this->password = $password;
    }
    
    public function type()
    {
        return $this->type;
    }
    
    public function validateAsAdmin()
    {
        $query = "select * from Admins where identification = '" . $this->identification . "' and password = '" . $this->password . "'";  
        $result = Login::query($query)->fetchAll(PDO::FETCH_CLASS, 'Admin');
        
        if (count($result) > 0)
        {
            $this->type = User::ADMIN;            
            return true;
        }        
        return false;       
    }
    
    public function validateAsOwner()
    {
        $query = "select * from Owners where identification = '" . $this->identification . "' and password = '" . $this->password . "'";
        $result = Login::query($query)->fetchAll(PDO::FETCH_CLASS, 'Owner');
        
        if (count($result) > 0)
        {
            $this->type = User::OWNER;            
            return true;
        }        
        return false;     
    }
    
    public function validateAsRecipient()
    {
        $query = "select * from Recipients where identification = '" . $this->identification . "' and password = '" . $this->password . "'";  
        $result = Login::query($query)->fetchAll(PDO::FETCH_CLASS, 'Recipient');
        
        if (count($result) > 0)
        {
            $this->type = User::RECIPIENT;            
            return true;
        }        
        return false;     
    }
    
    private static function query($query)
    {      
        Login::$dataController = new DataController();
        Login::$dataController->connect();        
        $result = Login::$dataController->query($query);        
        Login::$dataController->disconnect();
        
        return $result;
    }
    
    private static function exec($query)
    {
        Login::$dataController = new DataController();
        Login::$dataController->connect();
        $result = Login::$dataController->exec($query);
        Login::$dataController->disconnect();
        
        return $result;
    }
}

