<?php
session_start();

include_once("../php/Permission.php");

if (isset($_POST['save']))
{
    $permission = new Permission();
    $permission->lockSerial($_POST['lock']);
    $permission->recipientIdentification($_POST['recipient']);
    $permission->startDateHour($_POST['startDateHour']);
    $permission->endDateHour($_POST['endDateHour']);
    echo "tt";
    $permission->insert();
}
elseif (isset($_POST['update']))
{
    $permission = new Permission();
    $permission->lockSerial($_POST['lock']);
    $permission->recipientIdentification($_POST['recipient']);
    $permission->startDateHour($_POST['startDateHour']);
    $permission->endDateHour($_POST['endDateHour']);
    
    $permission->update();
}
elseif (isset($_POST['delete']))
{
    Permission::delete($_POST['lock'], $_POST['recipient']);
}

header("location: showPermissions.php");