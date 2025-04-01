

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
				<td width="20%"><h3 class="pageName">SEARCH IN MEMBERS</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<?php include '../searchBar.php'; ?>
	<div class="recordDisplayContainer">
			<table class="recordDisplay" id="table" width="100%">
				<tr>
					<th width="13%">Family ID</th>
					<th width="10%">Area</th>						
					<th width="10%">Status</th>	
					<th width="15%">Name</th>
					<th width="100px">Gender</th>
					<th width="30%">Address</th>
					<th>ACTIONS</th>
				</tr>
				<?php
					$sql = "SELECT * from family_member WHERE stationID = '$STATION_CODE'";
					$result = $conn->query($sql);				
					while ($rows=$result->fetch_assoc()){						 	
				?>

				<tr>
					<td><?php echo $rows['family_ID']; ?></td>
					<td><?php echo $rows['area_code']; ?></td>		
						
					<td><?php echo $rows['status']; ?></td>									
					<td><?php echo $rows['name'] . " " . $rows['surname'];; ?></td>
					<td><?php echo $rows['gender']; ?></td>
					<td><?php echo $rows['address']; ?></td>
					<td><a href="edit_member.php?id=<?php echo $rows['ID'];?>">Edit</a> &nbsp;&nbsp;&nbsp; <b>|</b> &nbsp;&nbsp;&nbsp;<a href="">View</a>  </td>							
				</tr>

		<?php } ?>
		</table>     			
    </div>
</div>
	<script src="../js/search_script.js"></script>
	<script src="../js/exportToExcel.js"></script>	
</body>
</html>