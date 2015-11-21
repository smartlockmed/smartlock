<?php
session_start();

include_once("../php/Permission.php");
?>

<html>
    <head>
        <title>Menu</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../styles/new.css" rel="stylesheet" type="text/css">
        <script>
            function selectPermission()
            {
                var radios = document.getElementsByName("permissions");
           
                for (i = 0; i < radios.length; i++)
                {
                    if (radios[i].checked)                                                      
                        return radios[i].value;                    
                }
                return null;
            }
            
            function showCodes(permissionId)
            {      
                document.getElementById("permissionId").value = permissionId;
                
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() 
                {
                    if (request.readyState == 4 && request.status == 200) 
                        document.getElementById("codes").innerHTML = request.responseText;            
                }                
                request.open("GET", "displayRecipientCodes.php?permissionId=" + permissionId, true);
                request.send();
            }     
           
            function generateCode(permissionId)
            {
                if (permissionId != null)
                {
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() 
                    {
                        if (request.readyState == 4 && request.status == 200)                         
                            document.getElementById("codes").innerHTML = request.responseText;                                                           
                    }                
                    request.open("GET", "addRecipientCode.php?permissionId=" + permissionId, true);
                    request.send();
                }
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
                    <a class="navbar-brand" href="#"><span>Brand</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="showRecipient.php">My Info</a></li>
                        <li><a href="aboutDevelopers.php">About Developers...</a></li>
                        <li><a href="logOut.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Permissions</legend>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Selection</th>
                                        <th>Serial</th>
                                        <th>Address</th>
                                        <th>Start Date-Hour</th>
                                        <th>End Date-Hour</th>
                                    </tr>
                                </thead>
                                <tbody id='permissions'>    
                                    <?php
                                    $permissionsLocks = Permission::searchByRecipient($_SESSION['identification']);
                                    $counter = 1;

                                    foreach ($permissionsLocks as $permission)
                                    {
                                        $lock = Lock::searchBySerial($permission->lockSerial());
                                        $row = "<tr>"
                                                . "<td>" . $counter++ . "</td>"
                                                . "<td><input type='radio' name='permissions' onchange='showCodes(selectPermission())' value='" . $permission->id() . "'></td>"
                                                . "<td>" . $lock->serial() . "</td>"
                                                . "<td>" . $lock->address() . "</td>"
                                                . "<td>" . $permission->startDateHour() . "</td>"
                                                . "<td>" . $permission->endDateHour() . "</td>"
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
                        <fieldset>
                            <legend>Codes</legend>                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Date-Hour</th>                                                                
                                    </tr>
                                </thead>
                                <tbody id='codes'>                                                             
                                </tbody>
                                <tfoot>                  
                                    <tr>
                                        <td>
                                             <form method="post" action="codeGenerationRecipient.php">
                                                <button type="submit" name="submit" class="btn btn-primary">Generator</button>  
                                                <input type="text" name="permissionId" id="permissionId" hidden>
                                            </form>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>