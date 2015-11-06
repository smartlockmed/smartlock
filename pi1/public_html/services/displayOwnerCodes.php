<?php
session_start();

include_once("../php/OwnerCode.php");

$lockSerial = $_REQUEST['lockSerial'];

$codes = OwnerCode::searchByLock($lockSerial);
$counter = 1;         

foreach ($codes as $code)
{    
    $row = "<tr>"
            . "<td>" . $counter++ . "</td>"
            . "<td>" . $code->code() . "</td>"
            . "<td>" . $code->dateHour() . "</td>"           
            . "</tr>";
    echo $row;
}