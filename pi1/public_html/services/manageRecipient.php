<?php
session_start();

include_once("../php/Recipient.php");

if (isset($_POST['submit']))
{   
    $recipient = new Recipient();
    $recipient->identification($_POST['identification']);
    $recipient->password($_POST['password']);
    $recipient->firstName($_POST['firstName']);
    $recipient->secondName($_POST['secondName']);
    $recipient->firstSurname($_POST['firstSurname']);
    $recipient->secondSurname($_POST['secondSurname']);
    $recipient->bornDate($_POST['bornDate']);
    $recipient->gender($_POST['gender']);
    $recipient->cellPhone($_POST['cellPhone']);
    $recipient->email($_POST['email']);
    $recipient->address($_POST['address']);
    
    $recipient->update();
}

header("location: showRecipient.php");