<?php
session_start();

include_once("../php/Recipient.php");
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../styles/new.css" rel="stylesheet" type="text/css">
        <script>      
              function selectRecipient()
            {
                var radios = document.getElementsByName("recipients");
           
                for (i = 0; i < radios.length; i++)
                {
                    if (radios[i].checked)                                                      
                        return radios[i].value;                    
                }
                return null;
            }
            
            function loadRecipientInForm(identification)
            {                        
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() 
                {
                    if (request.readyState == 4 && request.status == 200) 
                    {                        
                        var response = request.responseText;                       
                        var responses = response.split("#");
                        
                        document.getElementById("identification").value = responses[0];
                        document.getElementById("firstName").value = responses[1];
                        document.getElementById("secondName").value = responses[2];
                        document.getElementById("firstSurname").value = responses[3];
                        document.getElementById("secondSurname").value = responses[4];
                        document.getElementById("bornDate").value = responses[5];
                        document.getElementById("gender").value = responses[6];
                        document.getElementById("cellPhone").value = responses[7];
                        document.getElementById("email").value = responses[8];
                        document.getElementById("address").value = responses[9];                        
                    }
                }                
                request.open("GET", "getRecipient.php?identification=" + identification, true);
                request.send();
            }    
            
            function clearFields()
            {
                document.getElementById("identification").value = "";
                document.getElementById("firstName").value = "";
                document.getElementById("secondName").value = "";
                document.getElementById("firstSurname").value = "";
                document.getElementById("secondSurname").value = "";
                document.getElementById("bornDate").value = "";
                document.getElementById("gender").value = "";
                document.getElementById("cellPhone").value = "";
                document.getElementById("email").value = "";
                document.getElementById("address").value = "";
                document.getElementById("password").value = "";
            }
        </script>
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
                    <a class="navbar-brand" href="#">
                        <span>Brand</span>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="owner.php">Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Recipients</legend>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Selection</th>
                                        <th>Identification</th>                           
                                        <th>First Name</th>                             
                                        <th>First Surname</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $recipients = Recipient::searchByOwner($_SESSION['identification']);                                    
                                        $counter = 1;

                                        foreach ($recipients as $recipient)
                                        {                                        
                                            $row = "<tr>"                               
                                                    . "<td>" . $counter++ . "</td>"
                                                    . "<td><input type='radio' name='recipients' onchange='loadRecipientInForm(selectRecipient())' value='" . $recipient->identification() . "'></td>"
                                                    . "<td>" . $recipient->identification() . "</td>"
                                                    . "<td>" . $recipient->firstName() . "</td>"
                                                    . "<td>" . $recipient->firstSurname() . "</td>"
                                                    . "</tr>";
                                            echo $row;              
                                        }                            
                                    ?>                               
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="manageRecipients.php">
                            <div class="form-group">
                                <label class="control-label">Identification</label>
                                <input class="form-control" id="identification" name="identification" placeholder="Identification" type="text" value="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input class="form-control" id="password" name="password" placeholder="Password" type="password">
                            </div>
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input class="form-control" id="firstName" name="firstName" placeholder="First Name" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Second Name</label>
                                <input class="form-control" id="secondName" name="secondName" placeholder="Second Name" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">First Surname</label>
                                <input class="form-control" id="firstSurname" name="firstSurname" placeholder="First Surname" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Second Surname</label>
                                <input class="form-control" id="secondSurname" name="secondSurname" placeholder="Second Surname" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Born Date</label>
                                <input class="form-control" id="bornDate" name="bornDate" placeholder="Born Date" type="date">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unknown">Unknown</option>
                                </select>                        
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cell Phone</label>
                                <input class="form-control" id="cellPhone" name="cellPhone" placeholder="Cell Phone" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">E-mail</label>
                                <input class="form-control" id="email" name="email" placeholder="E-mail" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <input class="form-control" id="address" name="address" placeholder="Address" type="text">
                            </div>
                            <button type="button" name="new" class="btn btn-default" onclick="clearFields()">New</button>
                            <button type="submit" name="save" class="btn btn-default">Save</button>
                            <button type="submit" name="update" class="btn btn-default">Update</button>
                            <button type="submit" name="delete" class="btn btn-default">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>