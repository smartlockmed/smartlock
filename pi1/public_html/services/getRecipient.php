<?php
session_start();

include_once("../php/Recipient.php");

$identification = $_REQUEST['identification'];

$recipient = Recipient::search($identification);
    
echo $recipient->identification() . "#";
echo $recipient->firstName() . "#";
echo $recipient->secondName() . "#";
echo $recipient->firstSurname() . "#";
echo $recipient->secondSurname() . "#";
echo $recipient->bornDate() . "#";
echo $recipient->gender() . "#";
echo $recipient->cellPhone() . "#";
echo $recipient->email() . "#";
echo $recipient->address() . "#";

