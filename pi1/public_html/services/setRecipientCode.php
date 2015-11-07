<?php
session_start();

include_once("../php/RecipientCode.php");

$permissionId = $_REQUEST['permissionId'];

$recipientCode = new RecipientCode();
$recipientCode->permissionId($permissionId);
$recipientCode->generate();
$recipientCode->activate();      

 ob_end_clean();
 header("Connection: close");
 ignore_user_abort(); 
 ob_start();

 echo $recipientCode->code();

 $size = ob_get_length();
 header("Content-Length: $size");
 ob_end_flush(); 
 flush();         
 session_write_close(); 

//Background processing 
 sleep(30);
 RecipientCode::delete($recipientCode->permissionId(), $recipientCode->code());