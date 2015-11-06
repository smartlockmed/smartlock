<?php

/**
 * Description of Recipient
 *
 * @author Gersain Castañeda Muñoz
 */

include_once("User.php");

class Recipient extends User
{
    private $ownerIdentification;
    
    public function ownerIdentification($ownerIdentification = null)
    {
        if ($ownerIdentification == null)
            return $this->ownerIdentification;
        else
            $this->ownerIdentification = $ownerIdentification;
    }
    
    public static function delete($identification) 
    {
        $query = "delete from Recipients where identification = '" . $identification . "'";
        
        return Recipient::exec($query);
    }

    public function insert() 
    {       
        $query = "insert into Recipients (identification, ownerIdentification, password, firstName, secondName, firstSurname, secondSurname, bornDate, gender, cellPhone, email, address) values ('"
                . $this->identification . "', '"
                . $this->ownerIdentification . "', '"
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
       
        return Recipient::exec($query);
    }
    
    public function update()
    {
         $query = "update Recipients set "                              
                . "password = '" . $this->password . "', "
                . "bornDate = '" . $this->bornDate . "', "
                . "gender = '" . $this->gender . "', "
                . "cellPhone = '" . $this->cellPhone . "', "
                . "email = '" . $this->email . "', "
                . "address = '" . $this->address . "' "
                . "where identification = '" . $this->identification . "'";
       
        return Recipient::exec($query);
    }

    public static function search($identification) 
    {
        $query = "select * from Recipients where identification = '" . $identification . "'";
        
        $recipients = Recipient::query($query)->fetchAll(PDO::FETCH_CLASS, 'Recipient');
        
        return $recipients[0];
    }
    
    public static function searchByOwner($identification)
    {
        $query = "select * from Recipients where ownerIdentification = '" . $identification . "'";
        
        return Recipient::query($query)->fetchAll(PDO::FETCH_CLASS, 'Recipient');
    }

    public static function searchAll() {
        
    }

 

}
