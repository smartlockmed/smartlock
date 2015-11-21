<?php
    session_start();

    include_once("../php/Owner.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <link href="../styles/new.css" rel="stylesheet" type="text/css">
        <script>
            function selectOwner()
            {
                var radios = document.getElementsByName("owners");
                for (i = 0; i < radios.length; i++)
                {
                    if (radios[i].checked)      
                    {
                        document.getElementById("ownerIdentification").value = radios[i].value;
                        return radios[i].value;                    
                    }
                }
                return null;
            }
            
            function showLocks(identification)
            {             
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() 
                {
                    if (request.readyState == 4 && request.status == 200) 
                        document.getElementById("locks").innerHTML = request.responseText;            
                }                
                request.open("GET", "displayLocks.php?identification=" + identification, true);
                request.send();
                
                showCodes("");
            }
            
            function selectLock()
            {
                var radios = document.getElementsByName("locks");
                for (i = 0; i < radios.length; i++)
                {
                    if (radios[i].checked )
                    {
                        document.getElementById("lockSerial").value = radios[i].value;
                        return radios[i].value;
                    }
                }
                return null;
            }
            
            function showCodes(serial)
            {             
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() 
                {
                    if (request.readyState == 4 && request.status == 200) 
                        document.getElementById("codes").innerHTML = request.responseText;            
                }                
                request.open("GET", "displayCodes.php?serial=" + serial, true);
                request.send();
            }                                              
        </script>
    </head>
    <body>
        <fieldset>
            <legend>Manage Owners</legend>          
            <button onclick=''>Delete Owner</button>             
            <table id="t01" name=='owners'>
                <thead>
                    <th>Selection</th>
                    <th>Identification</th>
                    <th>First Name</th>
                    <th>Second Name</th>
                    <th>First Surname</th>
                    <th>Second Surname</th>
                    <th>Born Date</th>
                    <th>Gender</th>
                    <th>Cell Phone</th>
                    <th>Email</th>
                    <th>Address</th>                                                    
                </thead>
                <tbody>
                    <?php
                    $owners = Owner::searchAll();
                    foreach ($owners as $owner)
                    {
                        $row = "<tr>"
                                . "<td><input type='radio' name='owners' onchange='showLocks(selectOwner())' value='" . $owner->identification() . "'></td>"
                                . "<td>" . $owner->identification() . "</td>"
                                . "<td>" . $owner->firstName() . "</td>"
                                . "<td>" . $owner->secondName() . "</td>"
                                . "<td>" . $owner->firstSurname() . "</td>"
                                . "<td>" . $owner->secondSurname() . "</td>"
                                . "<td>" . $owner->bornDate() . "</td>"
                                . "<td>" . $owner->gender() . "</td>"
                                . "<td>" . $owner->cellPhone() . "</td>"
                                . "<td>" . $owner->email() . "</td>"
                                . "<td>" . $owner->address() . "</td>"
                                . "</tr>";
                        echo $row;
                    }                                                                                                                            
                    ?>   
                </tbody>
                <tfoot>
                    <tr>
                        <form action='addOwner.php' method='post'>
                            <td><input type='submit' name='submit' value='Add'></td>
                            <td><input type='text' name='identification' placeholder='Identification'></td>                            
                            <td><input type='text' name='firstName' placeholder='First Name'></td> 
                            <td><input type='text' name='secondName' placeholder='Second Name'></td>
                            <td><input type='text' name='firstSurname' placeholder='First Surname'></td>
                            <td><input type='text' name='secondSurname' placeholder='Second Surname'></td>
                            <td><input type='date' name='bornDate' placeholder='Born Date'></td>
                            <td><select name='gender'><option value='Male'>Male</option><option value='Female'>Female</option></select></td>
                            <td><input type='text' name='cellPhone' placeholder='Cell Phone'></td>
                            <td><input type='text' name='email' placeholder='Email'></td>
                            <td><input type='text' name='address' placeholder='Address'></td> 
                            <td><input type='password' name='password' placeholder='Password'></td>
                        </form>
                    </tr>                    
                </tfoot>
            </table>
        </fieldset>           
        <fieldset>
            <legend>Manage Locks</legend>  
            <button onclick=''>Delete Lock</button>   
            <button onclick=''>Generate Code</button>
            <table id='t01'>
                <thead>
                    <th>Selection</th>
                    <th>Serial</th>
                    <th>Address</th>
                    <th>Model</th>                                                                   
                </thead>
                <tbody id='locks'>
                </tbody>
                <tfoot>
                    <tr>
                        <form action='addLock.php' method='post'>
                            <td><input type='submit' name='submit' value='Add'></td>
                            <td><input type='text' name='serial' placeholder='Serial'></td>                             
                            <td><input type='text' name='address' placeholder='Address'></td> 
                            <td><input type='text' name='model' placeholder='Model'></td>
                            <td><input type='text' name='ownerIdentification' placeholder='Owner Identification' id='ownerIdentification' readonly></td> 
                        </form>
                    </tr>                    
                </tfoot>
            </table>
        </fieldset>
         <fieldset>
            <legend>Manage Codes</legend>  
            <button onclick=''>Delete Code</button>
            <table id='t01'>
                <thead>
                <th>Selection</th>
                    <th>Id</th>
                    <th>Code</th>
                    <th>Date Hour</th>                                                                                      
                </thead>
                <tbody id='codes'>
                </tbody>
                <tfoot>
                    <tr>
                        <form action='addCode.php' method='post'>
                            <td><input type='submit' name='submit' value='Generate'></td>
                            <td><input type='text' placeholder='Autogenerated' name='id' readonly></td>
                            <td><input type='text' placeholder='Autogenerated' name='code' readonly></td>
                            <td><input type='text' placeholder='Autogenerated' name='dateHour' readonly></td>
                            <td><input type='text' placeholder='Lock Serial' name='lockSerial' id='lockSerial' readonly></td>
                        </form>
                    </tr>                    
                </tfoot>
            </table>
        </fieldset>
    </body>
</html>