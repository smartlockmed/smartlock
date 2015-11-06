<?php

include_once("../php/Lock.php");

$identification = $_REQUEST['identification'];

$locks = Lock::searchByOwner($identification);
               
foreach ($locks as $lock)
{
    $row = "<tr>"
            . "<td><input type='radio' name='locks' onchange='showCodes(selectLock())' value='" . $lock->serial() . "'></td>"
            . "<td>" . $lock->serial() . "</td>"
            . "<td>" . $lock->address() . "</td>"
            . "<td>" . $lock->model() . "</td>"           
            . "</tr>";
    echo $row;
}                                                                                                                            
                

