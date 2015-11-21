<?php
session_start();

include_once("../php/Permission.php");
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
            
            function loadPermissionInForm(id)
            {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() 
                {
                    if (request.readyState == 4 && request.status == 200) 
                    {                        
                        var response = request.responseText;                       
                        var responses = response.split("#");
                        var startDateTime = responses[2].split(" ");
                        var endDateTime = responses[3].split(" ");                        
                                      
                        document.getElementById("recipient").value = responses[0];
                        document.getElementById("lock").value = responses[1];
                        document.getElementById("startDateHour").value = startDateTime[0] + "T" + startDateTime[1];
                        document.getElementById("endDateHour").value = endDateTime[0] + "T" + endDateTime[1];   
                    }
                }                
                request.open("GET", "getPermission.php?id=" + id, true);
                request.send();
            }
            
            function clearFields()
            {
                document.getElementById("recipient").value = "";
                document.getElementById("lock").value = "";
                document.getElementById("startDateHour").value = "";
                document.getElementById("endDateHour").value = "";
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
                        <li><a href="owner.php">Back</a></li>          
                    </ul>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Selection</th>
                                    <th>Recipient</th>
                                    <th>Lock</th>
                                    <th>Start Date Hour</th>
                                    <th>End Date Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $permissions = Permission::searchByOwner($_SESSION['identification']);                                    
                                    $counter = 1;

                                    foreach ($permissions as $permission)
                                    {                                        
                                        $row = "<tr>"                               
                                                . "<td>" . $counter++ . "</td>"
                                                . "<td><input type='radio' name='permissions' onchange='loadPermissionInForm(selectPermission())' value='" . $permission->id() . "'></td>"                      
                                                . "<td>" . $permission->recipientIdentification() . "</td>"                                 
                                                . "<td>" . $permission->lockSerial() . "</td>"
                                                . "<td>" . $permission->startDateHour() . "</td>"
                                                . "<td>" . $permission->endDateHour() . "</td>"
                                                . "</tr>";
                                        echo $row;              
                                    }                            
                                    ?>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="managePermissions.php">
                            <div class="form-group">
                                <label class="control-label">Recipient</label>
                                <select class="form-control" id="recipient" name="recipient">  
                                    <option selected></option>
                                    <?php
                                        $recipients = Recipient::searchByOwner($_SESSION['identification']);                                                                          

                                        foreach ($recipients as $recipient)                                                                             
                                            echo "<option>" . $recipient->identification() . "</option>";                                                                                       
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Lock</label>
                                <select class="form-control" id="lock" name="lock">  
                                    <option selected></option>
                                    <?php
                                        $locks = Lock::searchByOwner($_SESSION['identification']);

                                        foreach ($locks as $lock)                                                                             
                                            echo "<option>" . $lock->serial() . "</option>";                                                                                       
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Start Date Hour</label>
                                <input class="form-control" id="startDateHour" name="startDateHour" placeholder="Start Date-Hour" type="datetime-local">
                            </div>
                            <div class="form-group">
                                <label class="control-label">End Date-Hour</label>
                                <input class="form-control" id="endDateHour" name="endDateHour" placeholder="End Date-Hour" type="datetime-local">
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