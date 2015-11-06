<?php

include_once("../php/Owner.php");

if (isset($_POST['submit']))
{   
    $owner = new Owner();
    $owner->identification($_POST['identification']);
    $owner->password($_POST['password']);
    $owner->firstName($_POST['firstName']);
    $owner->secondName($_POST['secondName']);
    $owner->firstSurname($_POST['firstSurname']);
    $owner->secondSurname($_POST['secondSurname']);
    $owner->bornDate($_POST['bornDate']);
    $owner->gender($_POST['gender']);
    $owner->cellPhone($_POST['cellPhone']);
    $owner->email($_POST['email']);
    $owner->address($_POST['address']);
    
    $result = $owner->insert();    
    if ($result == -1)
        $GLOBALS['result'] = "Error";
    else
        $GLOBALS['result'] = "Done";
    
    header("location: admin.php");
}
else
{
}
