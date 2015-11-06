<?php
session_start();

include_once("../php/RecipientCode.php");

$permissionId = $_REQUEST['permissionId'];

$recipientCode = new RecipientCode();
$recipientCode->permissionId($permissionId);
$recipientCode->generate();
$recipientCode->activate();

$codes = RecipientCode::searchByPermission($permissionId);
$counter = 1;         

 ob_end_clean();
 header("Connection: close");
 ignore_user_abort(); 
 ob_start();

foreach ($codes as $code)
{        
    $row = "<tr>"
            . "<td>" . $counter++ . "</td>"
            . "<td>" . $code->code() . "</td>"
            . "<td>" . $code->dateHour() . "</td>"           
            . "</tr>";
    echo $row;
}  

 $size = ob_get_length();
 header("Content-Length: $size");
 ob_end_flush(); 
 flush();         
 session_write_close(); 

//Background processing 
 sleep(30);
 RecipientCode::delete($recipientCode->permissionId(), $recipientCode->code());