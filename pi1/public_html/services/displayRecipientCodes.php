<?php
session_start();

include_once("../php/RecipientCode.php");

$permissionId = $_REQUEST['permissionId'];


$codes = RecipientCode::searchByPermission($permissionId);
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