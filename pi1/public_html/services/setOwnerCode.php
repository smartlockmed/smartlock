<?php
session_start();

include_once("../php/OwnerCode.php");

$lockSerial = $_REQUEST['lockSerial'];

$ownerCode = new OwnerCode();
$ownerCode->lockSerial($lockSerial);
$ownerCode->generate();
$ownerCode->activate();        

 ob_end_clean();
 header("Connection: close");
 ignore_user_abort(); 
 ob_start();

echo $ownerCode->code();

 $size = ob_get_length();
 header("Content-Length: $size");
 ob_end_flush(); 
 flush();         
 session_write_close(); 

//Background processing 
 sleep(30);
 OwnerCode::delete($ownerCode->lockSerial(), $ownerCode->code());