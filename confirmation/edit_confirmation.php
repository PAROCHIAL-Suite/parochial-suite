
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<title></title>
</head>
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%" ><h3>EDIT CONFIRMATION RECORD</h3></td>
			</tr>
		</table>
		
	</div>
<br>

	
<?php
	include '../connection.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM confirmation WHERE reg_no = '$id' and stationID = '$STATION_CODE'";
    $result = $conn->query($sql); 
    while ($rows=$result->fetch_assoc()) { 
	
?>    	    
<form id="baptism_form" method="post" action="edit_script.php?id=<?php echo $id; ?>">
		<table width="100%"  border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="4"><h4>Certificate Details</h4></td>
			</tr><tr></tr>
			<tr>
				<td><p>REGISTRATION NO.</p></td>
				<td><input type="text" name="reg_no" value="<?php echo $rows['reg_no']; ?>" readonly></td>
			</tr>			<tr>
				<td><p>NAME</p></td>
				<td><input type="text" name="name" value="<?php echo $rows['name'];?>"></td>
			</tr>
			<tr>				
				<td><p>SURNAME</p></td>
				<td><input type="text" name="surname" value="<?php echo $rows['surname']; ?>"></td>				
			</tr>
			<tr>				
				<td><p>DATE OF BIRTH</p></td>
				<td><input type="text" name="dob" class="auto-format-date" value="<?php echo $rows['dob']; ?>" placeholder="dd/mm/yyy"></td>				
			</tr>			
			<tr>				
				<td><p>GENDER</p></td>
				<td>
					<select name="gender">
						<option hidden><?php echo $rows['gender']; ?></option>
						<option >Male</option>
						<option >Female</option>
					</select>
				</td>				
			</tr>
			<tr>				
				<td><p>FATHER'S NAME</p></td>
				<td><input type="text" name="father_name" value="<?php echo $rows['father_name']; ?>"></td>				
			</tr>		
			<tr>				
				<td><p>MOTHER'S NAME</p></td>
				<td><input type="text" name="mother_name" value="<?php echo $rows['mother_name']; ?>"></td>				
			</tr>			
			<tr>
				<td><p>BAPTISM DATE</p></td>
				<td><input type="text" class="auto-format-date" name="baptism_date" value="<?php echo $rows['baptism_date']; ?>"></td>
			</tr>			
			<tr>
				<td><p>BAPTISM REGISTRATION NO.</p></td>
				<td><input type="text" name="baptism_reg" value="<?php echo $rows['baptism_reg_no']; ?>"></td>
			</tr>
			<tr>				
				<td><p>BAPTISM PARISH NAME</p></td>
				<td><input type="text" name="baptism_parish" value="<?php echo $rows['baptism_parish']; ?>"></td>				
			</tr>	
			<tr>				
				<td><p>BAPTISM PARISH ADDRESS</p></td>
				<td><input type="text" name="p_address" value="<?php echo $rows['parish_address']; ?>"></td>				
			</tr>		
			<tr>				
				<td><p>CHURCH OF CONFIRMATION</p></td>
				<td><input type="text" name="church_of_confirmation" 
					value="<?php echo $rows['church_of_confirmation']; ?>"></td>				
			</tr>		
			<tr>				
				<td><p>DATE OF CONFIRMATION</p></td>
				<td><input type="text" class="auto-format-date" name="date" value="<?php echo $rows['date_of_confirmation']; ?>"></td>			
			</tr>							
			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td colspan="4"><h4>Parochial Details</h4></td>
			</tr><tr></tr>
			<tr>				
				<td><p>SPONSOR</p></td>
				<td><input type="text" name="sponsor" value="<?php echo $rows['sponsor']; ?>"></td>
								
			</tr>					
			<tr>
				<td ><p>MINISTER'S NAME</p></td>
				<td><input type="text" name="minister_name" value="<?php echo $rows['minister']; ?>"></td>
			</tr>
			<tr>				
				<td><p>PARISH PRIEST</p></td>
				<td><input type="text" name="parish_priest" 
					value="<?php echo $rows['parish_priest'];}?>" 
					></td>			
			</tr>			

			<tr></tr><tr></tr><tr></tr>
			<tr>
				<td></td>
				<td>  
					<input type="submit" name="edit_eucharist_from" id="saveFrm" value="Save">  </td>
				<td></td>
			</tr>
		</table>		
	</form><br><br>
</body>
</html>


