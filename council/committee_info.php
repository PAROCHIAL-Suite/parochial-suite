<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<title></title>
</head>
<body>

	<?php  ?>
	<?php include '../nav/global_nav.php';   $gID = $_GET['gID']; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="70%">
					<h3><?php 
	                $sql = "SELECT * FROM `council_group` WHERE ID = '$gID' AND  stationID = '$STATION_CODE'";
	                $result = $conn->query($sql);         
	                while ($rows=$result->fetch_assoc()) { echo $rows['group_name'];}
	            ?></h3>
				</td>				
			</tr>
		</table>

	</div>
	<br>
	<?php include '../simpleSearchBox.php'; ?>	
	<div class="recordDisplayContainer">	
		<table width="100%" class="recordDisplay" id="table">
		    <tr>
				<th width="80px">G. ID</th>
				<th width="260px">Name</th>
				<th width="260px">Contact No.</th>
				<th width="260px">Designation</th>
				<th>Action</th>
							
			</tr>
	
			<?php
  				include "../connection.php";
  				 
            	$sql = "SELECT * FROM council_member WHERE groupID = '$gID' AND  stationID = '$STATION_CODE' 
            	";

				$result = $conn->query($sql);									
			 	while ($rows=$result->fetch_assoc()){

		    ?>

			<tr>
				<td><?php echo $rows['groupID']; ?></td>
				<td><?php echo $rows['name'] ?></td>				
				<td><?php echo $rows['contact_no'] ?></td>				
				<td><?php echo $rows['designation'] ?></td>				
				<td><a href="edit_member.php?mem_id=<?php echo $rows['ID']; ?>&groupID=<?php echo $rows['groupID']; ?>">Edit</a>   </td>
			</tr>
		<?php   } ?>
		</table>
	</div>

</body>
</html>