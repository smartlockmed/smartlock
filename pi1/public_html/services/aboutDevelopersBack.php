<?php
session_start();

include_once("../php/User.php");

if ($_SESSION['type'] == User::OWNER)
    header("location: owner.php");
elseif ($_SESSION['type'] == User::RECIPIENT)
    header("location: recipient.php");