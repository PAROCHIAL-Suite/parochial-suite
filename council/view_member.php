<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<title></title>
</head>
<body>
	<?php include '../nav/global_nav.php';  ?>
	<br><br>
	<!-- PAGE TITLE -->
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="20%"><h3 class="pageName">SEARCH IN COUNCIL MEMBER</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<?php include '../simpleSearchBox.php'; ?>
	<div class="recordDisplayContainer">
		<table class="recordDisplay" id="table" width="100%" border="0">
			<tr>

				<th width="5%">Tenure</th>	
				<th width="10%">Group Name</th>	
				<th width="10%">Name</th>	
				<th width="5%">Gender</th>	
				<th width="5%">Contact</th>	
				<th width="10%">DESIGNATION</th>	
				<th width="10%">Elected/Nominated</th>	
				<th width="10%">Action</th>	
			</tr>		
		<?php
			include '../connection.php';
			$sql = "SELECT 
		    cmt.ID AS term_id,
		    cg.ID AS group_id,
		    cm.ID AS member_id,
		    cmt.start_date,
		    cmt.end_date,
		    cm.name, cm.contact_no, cm.elected_nominated, cm.gender,
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
		    cmt.stationID = '$STATION_CODE'";	
				 
				$result = $conn->query($sql);									
			 	while ($rows=$result->fetch_assoc()){						 	
		?>			
		<tr>		
	
			<td><?php echo $rows['start_date'] . "-" . $rows['end_date']; ?></td>
			<td><?php echo $rows['group_name']; ?></td>
			<td><?php echo $rows['name']; ?></td>
			<td><?php echo $rows['gender']; ?></td>
			<td><?php echo $rows['contact_no']; ?></td>
			<td><?php echo $rows['designation']; ?></td>		
			<td><?php echo $rows['elected_nominated']; ?></td>
			<td><a href="edit_member.php?mem_id=<?php echo $rows['member_id']; ?>&groupID=<?php echo $rows['group_id']; ?>">Edit</a> 
			<b>|</b>  
			<a href="delete_c_member.php?id=<?php echo $rows['member_id']; ?>">Delete</a>
			</td>	
		</tr>
		<?php } ?>
		</table>     			
    </div>
	</div>
	<script src="../js/search_script.js"></script>


</body>
</html>