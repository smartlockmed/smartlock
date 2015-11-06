<?php

/**
 * Description of RecipientCode
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("Code.php");

class RecipientCode extends Code
{
    private $permissionId;
    
    public function permissionId($permissionId)
    {
        if ($permissionId == null)
            return $this->permissionId;
        else
            $this->permissionId = $permissionId;
    }
    
    public function activate()
    {
        $this->dateHour(date('Y-m-d-H-i-s'));
        
        $query = "insert into RecipientCodes (permissionId, code, dateHour) values ('"
                . $this->permissionId . "', '"
                . $this->code . "', '"
                . $this->dateHour . "')";
        
        return RecipientCode::exec($query);
    }           

    public static function search($permissionId, $code) 
    {
        $query = "select * from RecipientCodes where permissionId = '" . $permissionId . "' and code = '" . $code . "'";
                 
        return RecipientCode::query($query)->fetchAll(PDO::FETCH_CLASS, 'RecipientCode');   
    }
    
    public static function searchByPermission($permissionId) 
    {
        $query = "select * from RecipientCodes where permissionId = '" . $permissionId . "'";
        
        return RecipientCode::query($query)->fetchAll(PDO::FETCH_CLASS, 'RecipientCode');
    }

    public function deactivate() {
        
    }

    public static function delete($permissionId, $code) 
    {
        $query = "delete from RecipientCodes where permissionId = '" . $permissionId . "' and code = '" . $code . "'";
        
        return RecipientCode::exec($query);
    }

    public static function searchAll() {
        
    }

//    public static function searchAll() 
//    {
//        $query = "select * from OwnerCodes";
// 
//        return OwnerCode::query($query)->fetchAll(PDO::FETCH_CLASS, 'OwnerCode');
//    }
//    
//    public static function delete($lockSerial, $code)
//    {
//        $query = "delete from OwnerCodes where lockSerial = '" . $lockSerial . "' and code = '" . $code . "'";
//        
//        return Owner::exec($query);
//    }
}
