<?php

/**
 * Description of DataController
 *
 * @author Gersain Castañeda Muñoz
 */
class DataController 
{    
    private $connection;
    
    public function connect()
    {        
        $hostdb = 'mysql15.000webhost.com';
        $namedb = 'a5966859_db';
        $userdb = 'a5966859_root';
        $passdb = 'ggbZQW311';

        try
        {
            $this->connection = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }              
    } 
    
    public function exec($query)
    {       
        return $this->connection->exec($query);                
    }
    
    public function query($query)
    {       
        return $this->connection->query($query);            
    }
    
    public function disconnect()
    {
        $this->connection = null;
    }        
}