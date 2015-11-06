<?php
session_start();


                                    $permissions = Permission::searchByOwner($_SESSION['identification']);                                    
                                    $counter = 1;

                                    foreach ($permissions as $permission)
                                    {                                        
                                        $row = "<tr>"                               
                                                . "<td>" . $counter++ . "</td>"
                                                . "<td><input type='radio' name='permissions' onchange='loadPermissionInForm(selectPermission())' value='" . $permission['identification'] . "'></td>"
                                                . "<td>" . $permission['firstName'] . " " . $permission['firstSurname'] . "</td>"                                 
                                                . "<td>" . $permission['address'] . "</td>"
                                                . "<td>" . $permission['startDateHour'] . "</td>"
                                                . "<td>" . $permission['endDateHour'] . "</td>"
                                                . "</tr>";
                                        echo $row;              
                                    }      