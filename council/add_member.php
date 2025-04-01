
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
	<?php include '../nav/global_nav.php'; $groupID = $_GET['id']; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%" ><h3>ADD GROUP MEMBER</h3></td>
			</tr>
		</table>
	</div>
<br>
	
	<form id="baptism_form" method="post" action="add_group_member.php?id=<?php echo $groupID; ?>" >
		<table width="100%"  border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="4"><h4>Add Member &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group ID: <?php echo $groupID; ?></h4></td>
			</tr><tr></tr>
			<tr>				
				<td><p>NAME</p></td>
				<td><input type="text" name="name"></td>				
				<td><p>DESIGNATION</p></td>
				<td>
					<select name="designation" required>
						<option hidden>--</option>
						<option selected>Member</option>
						<option>President</option>
						<option>Vice President</option>
						<option>Secretary</option>
						<option>Treserur</option>					
					</select>
				</td>							
			</tr>
			<tr>				
				<td><p>GENDER</p></td>
				<td>
					<select name="gender">
						<option>Male</option>
						<option>Female</option>
					</select>
				</td>	
			
				<td><p>CONTACT NO.</p></td>
				<td><input type="text" name="contact_no" ></td>
									
			</tr>
						
			<tr>

			</tr>	
			<tr>
				<td><p>NOMINATED/ELECTED</p></td>
				<td>
					<select name="nominated_elected">
						<option hidden>--</option>
						<option>Nomination</option>
						<option>Elected</option>
						<option>Ex Officio</option>
					</select>
				</td>
				
				<td><p>REMARKS</p></td>
				<td><input type="text" name="remarks"></td>				
			</tr>		
				
			<tr></tr><tr></tr><tr></tr>
			<tr>
			<td></td>
				<td>   
					<input type="submit" name="add_group_member" id="saveFrm" value="Save">  </td>
				<td></td>
			</tr>
		</table>		
	</form><br>
    <?php include '../simpleSearchBox.php'; ?>

	<div class="recordDisplayContainer" style="height: 39%;">
		<table class="recordDisplay" id="table" width="100%" border="0">
			<tr>

				<th width="5%">Tenure</th>	
				<th width="10%">Group Name</th>	
				<th width="10%">Name</th>	
				<th width="10%">DESIGNATION</th>	
			</tr>		
		<?php
			include '../connection.php';
			$sql = "SELECT 
		    cmt.ID AS term_id,
		    cg.ID AS group_id,
		    cm.ID AS member_id,
		    cmt.start_date,
		    cmt.end_date,
		    cm.name,
		    cm.designation,
		    cg.ID as cgID,
		    cg.group_name
		FROM 
		    council_master_table cmt
		INNER JOIN 
		    council_group cg ON cg.termID = cmt.ID AND cg.stationID = cmt.stationID
		INNER JOIN 
		    council_member cm ON cm.groupID = cg.ID AND cm.stationID = cg.stationID
		WHERE 
		    cmt.stationID = '$STATION_CODE'  AND cg.ID = '$groupID' ORDER BY cg.ID DESC";	
				 
				$result = $conn->query($sql);									
			 	while ($rows=$result->fetch_assoc()){	
			 	    
		?>			
		<tr>		
	
			<td><?php echo $rows['start_date'] . "-" . $rows['end_date']; ?></td>
			<td><?php echo $rows['group_name']; ?></td>
			<td><?php echo $rows['name']; ?></td>
			<td><?php echo $rows['designation']; ?></td>
		</tr>
		<?php } ?>
		</table>     			
    </div>
	</div>	
</body>
</html>


