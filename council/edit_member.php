<?php
	include "../connection.php";
	$memberID = $_GET['mem_id'];		 
   	$sql = "SELECT * FROM council_member WHERE ID = '$memberID' AND  stationID = '$STATION_CODE' 
            	";

	$result = $conn->query($sql);									
 	while ($rows=$result->fetch_assoc()){
 		$name =  $rows['name'];
 		$gender =  $rows['gender'];
 		$designation =  $rows['designation'];
 		$contact_no =  $rows['contact_no'];
 		$remarks =  $rows['remarks'];
 		$elected_nominated =  $rows['elected_nominated'];


 	}
?>
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
	<?php include '../nav/global_nav.php'; $memberID = $_GET['mem_id']; $grpID = $_GET['groupID']?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%" ><h3>ADD GROUP MEMBER</h3></td>
			</tr>
		</table>
	</div>
<br>
	
	<form id="baptism_form" method="post" action="edit_c_member.php?mem_id=<?php echo $memberID; ?>&group=<?php echo $grpID; ?>" >
		<table width="100%"  border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="4"><h4>Add Member &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MEMBER ID: <?php echo $memberID; ?></h4></td>
			</tr><tr></tr>
			<tr>				
				<td><p>NAME</p></td>
				<td><input type="text" name="name" value="<?php echo $name; ?>"></td>				
			</tr>
			<tr>				
				<td><p>GENDER</p></td>
				<td>
					<select name="gender">
						<option hidden><?php echo $gender; ?></option>
						<option>Male</option>
						<option>Female</option>
					</select>
				</td>				
			</tr>
			<tr>
				<td><p>CONTACT NO.</p></td>
				<td><input type="text" name="contact_no" value="<?php echo $contact_no; ?>"></td>
			</tr>						
			<tr>
				<td><p>DESIGNATION</p></td>
				<td>
					<select name="designation" required>
						<option hidden><?php echo $designation; ?></option>
						<option selected>Member</option>
						<option>Precident</option>
						<option>Vice precident</option>
						<option>Seceratry</option>
						<option>Treserur</option>
						<option>Ex Officio</option>
					</select>
				</td>			
			</tr>	
			<tr>
				<td><p>NOMINATED/ELECTED</p></td>
				<td>
					<select name="elected_nominated">
						<option hidden><?php echo $elected_nominated; ?></option>
						<option>Nomination</option>
						<option>Elected</option>
					</select>
				</td>
			</tr>	
			<tr>				
				<td><p>REMARKS</p></td>
				<td><input type="text" name="remarks" value="<?php echo $remarks; ?>"></td>				
			</tr>		
				
			<tr></tr><tr></tr><tr></tr>
			<tr>
			<td></td>
				<td>   
					<input type="submit" name="add_group_member" id="saveFrm" value="Update">  </td>
				<td></td>
			</tr>
		</table>		
	</form><br><br>
</body>
</html>


