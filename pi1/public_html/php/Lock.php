<?php

/**
 * Description of Lock
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("DataController.php");
include_once("Owner.php");

class Lock
{
    private $serial;
    private $ownerIdentification;
    private $address;
    private $model;
    private static $dataController;
    
    public function serial($serial = null)
    {
        if ($serial == null)
            return $this->serial;
        else
            $this->serial = $serial;
    }
    
    public function ownerIdentification($ownerIdentification = null)
    {
        if ($ownerIdentification == null)
            return $this->ownerIdentification;
        else
            $this->ownerIdentification = $ownerIdentification;
    }
    
    public function address($address = null)
    {
        if ($address == null)
            return $this->address;
        else
            $this->address = $address;        
    }
    
    public function model($model = null)
    {
        if ($model == null)
            return $this->model;
        else
            $this->model = $model;
    }
    
    public function insert()
    {
        $query = "insert into Locks (serial, ownerIdentification, address, model) values ('"
                . $this->serial . "', '"
                . $this->ownerIdentification . "', '"
                . $this->address . "', '"
                . $this->model . "')";

        return Lock::exec($query);
    }
    
    public function myOwner()
    {
        return Owner::searchByLock($this->serial);
    }
    
    private static function query($query)
    {      
        Lock::$dataController = new DataController();
        Lock::$dataController->connect();        
        $result = Lock::$dataController->query($query);        
        Lock::$dataController->disconnect();
        
        return $result;
    }
    
    private static function exec($query)
    {
        Lock::$dataController = new DataController();
        Lock::$dataController->connect();
        $result = Lock::$dataController->exec($query);
        Lock::$dataController->disconnect();
        
        return $result;
    }
    
    public static function searchBySerial($serial)
    {
        $query = "select * from Locks where serial = '" . $serial . "'";                    
        $locks =  Lock::query($query)->fetchAll(PDO::FETCH_CLASS, 'Lock');
        
        return $locks[0];
    }
    
    public static function searchByOwner($identification)
    {
        $query = "select * from Locks where ownerIdentification = '" . $identification . "'";
        
        return Lock::query($query)->fetchAll(PDO::FETCH_CLASS, 'Lock');
    }
        
    public static function searchAll() 
    {
        $query = "select * from Locks";
 
        return Lock::query($query)->fetchAll(PDO::FETCH_CLASS, 'Lock');
    }
    
    public static function delete($serial)
    {
        $query = "delete from Locks where serial = '" . $serial . "'";
        
        return Lock::exec($query);
    }
}
