<?php

include_once("../php/Lock.php");

if (isset($_POST['submit']))
{   
    $lock = new Lock();
    $lock->serial($_POST['serial']);
    $lock->ownerIdentification($_POST['ownerIdentification']);
    $lock->address($_POST['address']);
    $lock->model($_POST['model']);
    
    $result = $lock->insert();    
    if ($result == -1)
        $GLOBALS['result'] = "Error";
    else
        $GLOBALS['result'] = "Done";
    
    header("location: admin.php");
}
else
{
}