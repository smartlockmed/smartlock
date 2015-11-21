<?php
session_start();

include_once("../php/Recipient.php");

$recipient = Recipient::search($_SESSION['identification']);
?>

<html>
    <head>
        <title>My Info</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../styles/new.css" rel="stylesheet" type="text/css">     
    </head>
    <body>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>Brand</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="recipient.php">Back</a>
                        </li>                     
                    </ul>
                </div>
            </div>
        </div>        
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="manageRecipient.php">
                            <div class="form-group">
                                <label class="control-label">Identification</label>
                                <input class="form-control" name="identification" placeholder="Identification" type="text" value="<?=$recipient->identification()?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input class="form-control" name="password" placeholder="Password" type="password">
                            </div>
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input class="form-control" name="firstName" placeholder="First Name" type="text" value="<?=$recipient->firstName()?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Second Name</label>
                                <input class="form-control" name="secondName" placeholder="Second Name" type="text" value="<?=$recipient->secondName()?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">First Surname</label>
                                <input class="form-control" name="firstSurname" placeholder="First Surname" type="text" value="<?=$recipient->firstSurname()?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Second Surname</label>
                                <input class="form-control" name="secondSurname" placeholder="Second Surname" type="text" value="<?=$recipient->secondSurname()?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Born Date</label>
                                <input class="form-control" name="bornDate" placeholder="Born Date" type="date" value="<?=$recipient->bornDate()?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <select class="form-control" name="gender" value="<?=$recipient->gender()?>">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unknown">Unknown</option>
                                </select>                        
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cell Phone</label>
                                <input class="form-control" name="cellPhone" placeholder="Cell Phone" type="text" value="<?=$recipient->cellPhone()?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">E-mail</label>
                                <input class="form-control" name="email" placeholder="E-mail" type="text" value="<?=$recipient->email()?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <input class="form-control" name="address" placeholder="Address" type="text" value="<?=$recipient->address()?>">
                            </div>
                            <button type="submit" name="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>