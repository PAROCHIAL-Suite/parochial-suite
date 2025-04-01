<?php
    include '../connection.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM baptism WHERE reg_no = '$id' and stationID = '$STATION_CODE'";
    $result = $conn->query($sql); 
    while ($rows=$result->fetch_assoc()) { 
        $last_update = $rows['last_update'];
        $name = $rows['name'];
        $surname = $rows['surname'];
?>   

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/ui.css">        
    <link rel="stylesheet" type="text/css" href="../css/baptism.css">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <?php include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName card-heading">
        <table border="0">
            <tr>
                <td width="40%"><h3>EDIT BAPTISM</h3></td>
            </tr>
        </table>
    </div>    
    <Br>
         
        <!-- <div class="legend" style="float: left; width: 59.2%;">Edit baptism information</div>  -->
    <div style="" class="">   
        <form id="" method="post" action="update_btsm_data.php?id=<?php echo $_GET['id']; ?>" class="form ">
           <table width="100%"  border="0" cellspacing="10" class="" style="font-family: 'Source Sans 3',sans-serif; margin: auto; ">
                <tr>
                    <td colspan="6"><h4>Registration Details</h4></td>                                         
                </tr>            
                <tr>
                    <td><p>REGISTRATION NO.</p></td>                   
                    <td><input type="text" name="reg_no" value="<?php echo $rows['reg_no']; ?>"> </td>    
                    <td><p>DATE OF BAPTISM</p></td>                   
                    <td><input type="text" name="baptism_dt" class="auto-format-date" value="<?php echo $rows['baptism_date']; ?>"></td>
                </tr>    
                <tr>
                    <td><p>SEX</p></td>                    
                    <td>
                        <select name="gender">
                            <option hidden><?php echo $rows['gender']; ?></option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </td>  
                </tr>           
                <tr></tr><tr></tr><tr></tr>
                <tr>
                <td colspan="6"><h4>Neophytes Details</h4></td>
                </tr><tr></tr>                                     
                <tr>
                    <td><p>NAME</p></td>                    
                    <td><input type="text" name="name" value="<?php echo $rows['name']; ?>"></td>          
                    <td><p>SURNAME</p></td>                       
                    <td><input type="text" name="surname" value="<?php echo $rows['surname']; ?>"></td>
                </tr>   
                <tr>
                    <td><p>DATE OF BIRTH</p></td>                        
                    <td><input type="text" name="dob" class="auto-format-date" value="<?php echo $rows['dob']; ?>"></td>
                </tr>  
                <tr>
                    <td><p>FATHER'S NAME</p></td>                
                    <td><input type="text" name="father_name" value="<?php echo $rows['father_name']; ?>"></td>             
                    <td><p>MOTHER'S NAME</p></td>                        
                    <td><input type="text" name="mother_name" value="<?php echo $rows['mother_name']; ?>"></td>
                </tr> 
                <tr>
                    <td><p>Address</p></td>                    
                    <td><input type="text" name="address" value="<?php echo $rows['address']; ?>"></td>
                </tr>
                <tr>
                    <td><p>FATHER'S OCCUPATION</p></td>                        
                    <td><input type="text" name="father_occupation" value="<?php echo $rows['father_occupation']; ?>"></td>
                    
                    <td><p>FATHER'S NATIONALITY</p></td>
                    
                    <td><input type="text" name="father_nationality" value="<?php echo $rows['father_nationality']; ?>"></td>
                </tr>
                <tr></tr><tr></tr><tr></tr>
                <tr>
                    <td colspan="6"><h4>Godparent's Details</h4></td>
                </tr><tr></tr>                    
                <tr>
                    <td><p>GODFATHER'S NAME</p></td>                
                    <td><input type="text" name="godfather_name" value="<?php echo $rows['godfather_name']; ?>"></td>
                   
                    <td><p>HIS ADDRESS</p></td>                        
                    <td><input type="text" name="godfather_address" value="<?php echo $rows['godmother_address']; ?>"></td>
                </tr>    
                <tr>
                    <td><p>GONDMOTHER'S NAME</p></td>                        
                    <td><input type="text" name="godmother_name" value="<?php echo $rows['godmother_name']; ?>"></td>                  
                    <td><p>HER ADDRESS</p></td>                        
                    <td><input type="text" name="godmother_address" value="<?php echo $rows['godmother_address']; ?>"></td>
                </tr>   
                <tr></tr><tr></tr><tr></tr>
                <tr>
                    <td colspan="6"><h4>Sacrament Details</h4></td>
                </tr><tr></tr>                    
                <tr>
                    <td><p>PLACE OF BAPTISM</p></td>                        
                    <td><input type="text" name="church_name" value="<?php echo $rows['church_name']; ?>"></td>
                    
                    <td><p>MINISTER'S NAME</p></td>
                        
                    <td><input type="text" name="minister_name" value="<?php echo $rows['minister_name']; ?>"></td>
                    </tr>           
                    <tr>
                        <td><p>FIRST COMMUNION</p></td>                        
                        <td><input type="text" name="communion" value="<?php echo $rows['communion']; ?>"></td>
                    
                        <td><p>CONFIRMATION</p></td>                        
                        <td><input type="text" name="confirmation" value="<?php echo $rows['confirmation']; ?>"></td>
                    </tr>     
                    <tr>
                        <td><p>MARRAIGE</p></td>                        
                        <td><input type="text" name="marriage" value="<?php echo $rows['marriage']; ?>"></td>                    
                        <td><p>REMARKS</p></td>                        
                        <td><input type="text" name="remarks" value="<?php echo $rows['remarks']; ?>"></td>
                    </tr>       
                    <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                    <tr>
                        <td></td>                        
                        <td><input type="submit" name="update_btsm_info" value="Update" style="float: left;"></p></td>
                    </tr>                          
                    <?php } ?>  
                 </table>
            </div>
        </div>

</body>
</html>