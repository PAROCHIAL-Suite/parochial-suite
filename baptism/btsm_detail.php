<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">		
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php include '../nav/global_nav.php'; ?><br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%" ><h3>BAPTISM CERTIFICATE</h3></td>
			</tr>
		</table>
	</div>
    <?php
        include '../connection.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM baptism WHERE reg_no = '$id'";
        $result = $conn->query($sql); 
        while ($rows=$result->fetch_assoc()) { 
   ?>
	<table width="50%" border="0" cellspacing="7" class="recordDisplayContainer" style="margin-left: 30px;">
        <tr>
            <td width="180px"><b>Registration No.</b></td>
            <th width="20px">:</th>
    	    <td><?php echo $rows['reg_no']; ?></td>
        </tr>
        <tr>
            <td><b>Date of baptism</b></td>
        	   <th>:</th>
             <td><?php echo $rows['baptism_date']; ?></td>
        </tr>    
        <tr>
            <td><b>Sex</b></td>
            <th>:</th>
            <td><?php echo $rows['dob']; ?></td>
        </tr>                            
        <tr>
            <td><b>Name</b></td>
            <th>:</th>
            <td><?php echo $rows['name']; ?></td>
        </tr>
        <tr>
            <td><b>Surname</b></td>
            <th>:</th>
            <td><?php echo $rows['surname']; ?></td>
        </tr>   
        <tr>
            <td><b>Date of birth</b></td>
            <th>:</th>
            <td><?php echo $rows['dob']; ?></td>
        </tr>  
        <tr>
            <td><b>Father's Name</b></td>
            <th>:</th>
            <td><?php echo $rows['father_name']; ?></td>
        </tr>                
        <tr>
            <td><b>Mother's Name</b></td>
            <th>:</th>
            <td><?php echo $rows['mother_name']; ?></td>
        </tr> 
        <tr>
            <td><b>Address</b></td>
            <th>:</th>
            <td><?php echo $rows['address']; ?></td>
        </tr>            
        <tr>
            <td><b>Father's Occupation</b></td>
            <th>:</th>
            <td><?php echo $rows['father_occupation']; ?></td>
        </tr>                       
        <tr>
            <td><b>Father's Nationality</b></td>
            <th>:</th>
            <td><?php echo $rows['father_nationality']; ?></td>
        </tr>
        <tr>
            <td><b>Godfather's Name</b></td>
            <th>:</th>
            <td><?php echo $rows['godfather_name']; ?></td>
        </tr>                                       
        <tr>
            <td><b>His Address</b></td>
            <th>:</th>
            <td><?php echo $rows['godfather_address']; ?></td>
        </tr>    
        <tr>
            <td><b>Godmother's Name</b></td>
            <th>:</th>
            <td><?php echo $rows['godmother_name']; ?></td>
        </tr>                                       
        <tr>
            <td><b>Her Address</b></td>
            <th>:</th>
            <td><?php echo $rows['godmother_address']; ?></td>
        </tr>   
        <tr>
            <td><b>Place of baptism</b></td>
            <th>:</th>
            <td><?php echo $rows['church_name']; ?></td>
        </tr>                                       
        <tr>
            <td><b>Minister's Name</b></td>
            <th>:</th>
            <td><?php echo $rows['minister_name']; ?></td>
        </tr>           
        <tr>
            <td><b>First Communion</b></td>
            <th>:</th>
            <td><?php echo $rows['communion']; ?></td>
        </tr>                 
        <tr>
            <td><b>Confirmation</b></td>
            <th>:</th>
            <td><?php echo $rows['confirmation']; ?></td>
        </tr>     
        <tr>
            <td><b>Marriage</b></td>
            <th>:</th>
            <td><?php echo $rows['marriage']; ?></td>
        </tr>                       
        <tr>
            <td><b>Remarks</b></td>
            <th>:</th>
            <td><?php echo $rows['remarks']; }?></td>
        </tr>                                                              
    </table>
</body>
</html>