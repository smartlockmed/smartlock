<?php 
session_start();

include_once("../php/Login.php");

if (isset($_POST['login']))
{     
    $login = new Login($_POST['identification'], $_POST['password']);
    
    if ($login->validateAsAdmin())
    {
        $_SESSION['identification'] = $login->identification();
        $_SESSION['password'] = $login->password();
        $_SESSION['type'] = $login->type();
        
        header("location: admin.php");                
    }
    elseif ($login->validateAsOwner())
    {
        $_SESSION['identification'] = $login->identification();
        $_SESSION['password'] = $login->password();
        $_SESSION['type'] = $login->type();

        header("location: owner.php");
    }
    elseif ($login->validateAsRecipient())
    {
        $_SESSION['identification'] = $login->identification();
        $_SESSION['password'] = $login->password();
        $_SESSION['type'] = $login->type();
        
        header("location: recipient.php");
    }
    else
        header("location: index.php");
}
else
    header("location: index.php");
    