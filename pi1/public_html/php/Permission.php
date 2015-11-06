<?php

/**
 * Description of Permission
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("DataController.php");
include_once("Recipient.php");
include_once("Lock.php");

class Permission 
{
    private $id;
    private $lockSerial;
    private $recipientIdentification;
    private $startDateHour;
    private $endDateHour;
    private static $dataController;
    
    public function id($id = null)
    {
        if ($id == null)
            return $this->id;
        else
            $this->id = $id;
    }
    
    public function lockSerial($lockSerial = null)
    {
        if ($lockSerial == null)
            return $this->lockSerial;
        else
            $this->lockSerial = $lockSerial;
    }
    
    public function recipientIdentification($recipientIdentification = null)
    {
        if ($recipientIdentification == null)
            return $this->recipientIdentification;
        else
            $this->recipientIdentification = $recipientIdentification;
    }
    
    public function startDateHour($startDateHour = null)
    {
        if ($startDateHour == null)
            return $this->startDateHour;
        else
            $this->startDateHour = $startDateHour;
    }
    
    public function endDateHour($endDateHour = null)
    {
        if ($endDateHour == null)
            return $this->endDateHour;
        else
            $this->endDateHour = $endDateHour;
    }       
    
    public function insert()
    {
        $query = "insert into Permissions (lockSerial, recipientIdentification, startDateHour, endDateHour) values ('"
                . $this->lockSerial . "', '"
                . $this->recipientIdentification . "', '"
                . $this->startDateHour . "', '"
                . $this->endDateHour . "')";

        echo Permission::exec($query);
    }
    
    public function update()
    {
         $query = "update Permissions set "                              
                . "startDateHour = '" . $this->startDateHour . "', "
                . "endDateHour = '" . $this->endDateHour . "' "             
                . "where lockSerial = '" . $this->lockSerial . "' and recipientIdentification = '" . $this->recipientIdentification . "'";
       
        return Permission::exec($query);
    }
    
    public function myLock()
    {
        return Lock::searchBySerial($this->lockSerial);
    }
    
    public function myRecipient()
    {
        return Recipient::searchByIdentification($this->recipientIdentification);
    }
    
    private static function query($query)
    {      
        Permission::$dataController = new DataController();
        Permission::$dataController->connect();        
        $result = Permission::$dataController->query($query);        
        Permission::$dataController->disconnect();
        
        return $result;
    }
    
    private static function exec($query)
    {
        Permission::$dataController = new DataController();
        Permission::$dataController->connect();
        $result = Permission::$dataController->exec($query);
        Permission::$dataController->disconnect();
        
        return $result;
    }
    
    public static function search($id)
    {
         $query = "select * from Permissions where id = '" . $id . "'";
                    
        $permissions = Permission::query($query)->fetchAll(PDO::FETCH_CLASS, 'Permission');               
                
        return $permissions[0];
    }
    
    public static function searchByRecipient($recipientIdentification)
    {
        $query = "select * from Permissions where recipientIdentification = '" . $recipientIdentification . "'";
                    
        return Permission::query($query)->fetchAll(PDO::FETCH_CLASS, 'Permission');       
    }
    
    public static function searchByOwner($identification)
    {
        $query = "select Permissions.id, Permissions.lockSerial, Permissions.recipientIdentification, Permissions.startDateHour, Permissions.endDateHour "
                . "from Permissions, Locks, Owners "
                . "where Permissions.lockSerial = Locks.serial and "
                . "Locks.ownerIdentification = Owners.identification and "
                . "Owners.identification = '" . $identification . "'";              
              
        return Permission::query($query)->fetchAll(PDO::FETCH_CLASS, 'Permission');               
    }
//        
//    public static function searchAll() 
//    {
//        $query = "select * from Perm";
// 
//        return Lock::query($query)->fetchAll(PDO::FETCH_CLASS, 'Lock');
//    }
//    
    public static function delete($lockSerial, $recipientIdentification)
    {
        $query = "delete from Permissions where lockSerial = '" . $lockSerial . "' and recipientIdentification = '" . $recipientIdentification . "'";
        
        return Permission::exec($query);
    }
}
