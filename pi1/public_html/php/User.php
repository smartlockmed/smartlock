<?php

/**
 * Description of User
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("DataController.php");

abstract class User 
{
    protected $identification;
    protected $password;
    protected $firstName;
    protected $secondName;
    protected $firstSurname;
    protected $secondSurname;
    protected $bornDate;
    protected $gender;
    protected $cellPhone;
    protected $email;
    protected $address;
    protected static $dataController;

    const ADMIN = 0;
    const OWNER = 1;
    const RECIPIENT = 2;
    
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
    
    public function firstName($firstName = null)
    {
        if ($firstName == null)
            return $this->firstName;
        else
            $this->firstName = $firstName;        
    }      
    
    public function secondName($secondName = null)
    {
        if ($secondName == null)
            return $this->secondName;
        else
            $this->secondName = $secondName;
    }   
    
    public function firstSurname($firstSurname = null)
    {
        if ($firstSurname == null)
            return $this->firstSurname;
        else
            $this->firstSurname = $firstSurname;        
    }       
    
    public function secondSurname($secondSurname = null)
    {
        if ($secondSurname == null)
            return $this->secondSurname;
        else
            $this->secondSurname = $secondSurname;
    }
    
    public function bornDate($bornDate = null)
    {
        if ($bornDate == null)
            return $this->bornDate;
        else
            $this->bornDate = $bornDate;
    }
    
    public function gender($gender = null)
    {
        if ($gender == null)
            return $this->gender;
        else
            $this->gender = $gender;
    }
    
    public function cellPhone($cellPhone = null)
    {
        if ($cellPhone == null)
            return $this->cellPhone;
        else
            $this->cellPhone = $cellPhone;
    }
    
    public function email($email = null)
    {
        if ($email == null)
            return $this->email;
        else
            $this->email = $email;
    }
    
    public function address($address = null)
    {
        if ($address == null)
            return $this->address;
        else
            $this->address = $address;
    }
        
    protected static function query($query)
    {      
        User::$dataController = new DataController();
        User::$dataController->connect();        
        $result = User::$dataController->query($query);        
        User::$dataController->disconnect();
        
        return $result;
    }
    
    protected static function exec($query)
    {
        User::$dataController = new DataController();
        User::$dataController->connect();
        $result = User::$dataController->exec($query);
        User::$dataController->disconnect();
        
        return $result;
    }
    
    public static abstract function searchAll();
    
    public abstract function insert();
    
    public static abstract function delete($identification);
}
