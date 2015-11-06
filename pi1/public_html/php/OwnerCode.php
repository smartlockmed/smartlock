<?php

/**
 * Description of OwnerCode
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("Code.php");

class OwnerCode extends Code
{
    private $lockSerial;
    
    public function lockSerial($lockSerial)
    {
        if ($lockSerial == null)
            return $this->lockSerial;
        else
            $this->lockSerial = $lockSerial;
    }
    
    public function activate()
    {
        $this->dateHour(date('Y-m-d-H-i-s'));
        
        $query = "insert into OwnerCodes (lockSerial, code, dateHour) values ('"
                . $this->lockSerial . "', '"
                . $this->code . "', '"
                . $this->dateHour . "')";
        
        return OwnerCode::exec($query);
    }
    
    public function deactivate() 
            {
        
    }    

    public static function search($lockSerial, $code) 
    {
        $query = "select * from OwnerCodes where lockSerial = '" . $lockSerial . "' and code = '" . $code . "'";
                 
        return OwnerCode::query($query)->fetchAll(PDO::FETCH_CLASS, 'OwnerCode');   
    }
    
    public static function searchByLock($serial) 
    {
        $query = "select * from OwnerCodes where lockSerial = '" . $serial . "'";
        
        return OwnerCode::query($query)->fetchAll(PDO::FETCH_CLASS, 'OwnerCode');
    }
        
    public static function searchAll() 
    {
        $query = "select * from OwnerCodes";
 
        return OwnerCode::query($query)->fetchAll(PDO::FETCH_CLASS, 'OwnerCode');
    }
    
    public static function delete($lockSerial, $code)
    {
        $query = "delete from OwnerCodes where lockSerial = '" . $lockSerial . "' and code = '" . $code . "'";
        
        return OwnerCode::exec($query);
    }
}
