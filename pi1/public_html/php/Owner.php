<?php

/**
 * Description of Owner
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("User.php");
include_once("Lock.php");

class Owner extends User 
{     
    public function insert() 
    {       
        $query = "insert into Owners (identification, password, firstName, secondName, firstSurname, secondSurname, bornDate, gender, cellPhone, email, address) values ('"
                . $this->identification . "', '"
                . $this->password . "', '"
                . $this->firstName . "', '"
                . $this->secondName . "', '"
                . $this->firstSurname . "', '"
                . $this->secondSurname . "', '"
                . $this->bornDate . "', '"
                . $this->gender . "', '"
                . $this->cellPhone . "', '"
                . $this->email . "', '"
                . $this->address . "')";
       
        return Owner::exec($query);
    }
    
    public function update()
    {
         $query = "update Owners set "                              
                . "password = '" . $this->password . "', "
                . "bornDate = '" . $this->bornDate . "', "
                . "gender = '" . $this->gender . "', "
                . "cellPhone = '" . $this->cellPhone . "', "
                . "email = '" . $this->email . "', "
                . "address = '" . $this->address . "' "
                . "where identification = '" . $this->identification . "'";
       
        return Owner::exec($query);
    }
    
    public function myLocks()
    {
        return Lock::searchByOwner($this->identification);
    }
    
    public static function search($identification)
    {
        $query = "select * from Owners where identification = '" . $identification . "'";

        $owners = Owner::query($query)->fetchAll(PDO::FETCH_CLASS, 'Owner');  
        
        return $owners[0];
    }
    
    public static function searchByLock($serial)
    {
        $query = "select Owners.* from Owners, Locks where Locks.serial = '" . $serial . "' and Locks.ownerIdentification = Owners.identification";
        
        return Owner::query($query)->fetchAll(PDO::FETCH_CLASS, 'Owner');
    }
        
    public static function searchAll() 
    {
        $query = "select * from Owners";
 
        return Owner::query($query)->fetchAll(PDO::FETCH_CLASS, 'Owner');
    }
    
    public static function delete($identification) 
    {
        $query = "delete from Owners where identification = '" . $identification . "'";
        
        return Owner::exec($query);
    }
}
