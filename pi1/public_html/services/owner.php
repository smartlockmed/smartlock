<?php
session_start();

include_once("../php/Lock.php");
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
            function selectLock()
            {
                var radios = document.getElementsByName("locks");
           
                for (i = 0; i < radios.length; i++)
                {
                    if (radios[i].checked)                                                      
                        return radios[i].value;                    
                }
                return null;
            }
            
            function showCodes(lockSerial)
            {             
                document.getElementById("lockSerial").value = lockSerial;
            
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() 
                {
                    if (request.readyState == 4 && request.status == 200) 
                        document.getElementById("codes").innerHTML = request.responseText;            
                }                
                request.open("GET", "displayOwnerCodes.php?lockSerial=" + lockSerial, true);
                request.send();
            }     
           
            function generateCode(lockSerial)
            {
                if (lockSerial != null)
                {
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() 
                    {
                        if (request.readyState == 4 && request.status == 200)                         
                            document.getElementById("codes").innerHTML = request.responseText;                                                           
                    }                
                    request.open("GET", "addOwnerCode.php?lockSerial=" + lockSerial, true);
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
                        <li><a href="showRecipients.php">Recipients</a></li>
                        <li><a href="showPermissions.php">Permissions</a></li>
                        <li><a href="showOwner.php">My Info</a></li>
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
                            <legend>Locks</legend>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Selection</th>
                                        <th>Serial</th>
                                        <th>Address</th>
                                        <th>Model</th>                                        
                                    </tr>
                                </thead>
                                <tbody id='locks'>    
                                    <?php
                                    $locks = Lock::searchByOwner($_SESSION['identification']);
                                    $counter = 1;

                                    foreach ($locks as $lock)
                                    {                                        
                                        $row = "<tr>"
                                                . "<td>" . $counter++ . "</td>"
                                                . "<td><input type='radio' name='locks' onchange='showCodes(selectLock())' value='" . $lock->serial() . "'></td>"
                                                . "<td>" . $lock->serial() . "</td>"
                                                . "<td>" . $lock->address() . "</td>"
                                                . "<td>" . $lock->model() . "</td>"                                              
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
                                            <form method="post" action="codeGeneration.php">
                                                <button type="submit" name="submit" class="btn btn-primary">Generator</button>  
                                                <input type="text" name="lockSerial" id="lockSerial" hidden>
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