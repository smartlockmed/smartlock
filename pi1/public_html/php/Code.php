<?php

/**
 * Description of Code
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("DataController.php");

abstract class Code 
{
    protected $id;
    protected $code;
    protected $dateHour;
    protected static $dataController;
    
    public function id($id = null)
    {
        if ($id == null)
            return $this->id;
        else
            $this->id = $id;       
    }
    
    public function code($code = null)
    {
        if ($code == null)
            return $this->code;
        else
            $this->code = $code;                   
    }
    
    public function dateHour($dateHour = null)
    {
        if ($dateHour == null)
            return $this->dateHour;
        else
            $this->dateHour = $dateHour;
    }
    
    public function expired()
    {
        
    }
    
    public function generate()
    {
        $this->code = rand(100000, 999999);
        
        return $this->code;
    }
    
    protected static function query($query)
    {      
        Code::$dataController = new DataController();
        Code::$dataController->connect();        
        $result = Code::$dataController->query($query);        
        Code::$dataController->disconnect();
        
        return $result;
    }
    
    protected static function exec($query)
    {
        Code::$dataController = new DataController();
        Code::$dataController->connect();
        $result = Code::$dataController->exec($query);
        Code::$dataController->disconnect();
        
        return $result;
    }
    
    public abstract function activate();
    
    public abstract function deactivate();  
    
    public static abstract function searchAll();
    
    public static abstract function search($lockSerial, $code);
    
    public static abstract function delete($lockSerial, $code);
}
