<?php
session_start();

include_once("../php/Permission.php");

$id = $_REQUEST['id'];

$permission = Permission::search($id);
    
echo $permission->recipientIdentification() . "#";
echo $permission->lockSerial() . "#";
echo $permission->startDateHour() . "#";
echo $permission->endDateHour();