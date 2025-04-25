

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
				<td width="20%"><h3 class="pageName">SEARCH IN FAMILY</h3></td>
			</tr>
		</table>
	</div>
	<br>
<?php include '../searchBar.php'; ?>
	<div class="recordDisplayContainer">
		<table class="recordDisplay" id="table" width="100%" border="0">
			<tr>
				<th width="100px">Family ID</th>		
				<th width="120px">Area Code</th>	
				<th width="200px">Family Name</th>	
				<th width="450px">Address</th>
				<th id="action">ACTIONS</th>
			</tr>		
		<?php
			include '../connection.php';
			$sql = " SELECT * FROM family_master_table 
			WHERE stationID = '$STATION_CODE'";
			$result = $conn->query($sql);									
			while ($rows=$result->fetch_assoc()){						 	
		?>			
		<tr>		

			<td style="text-align: center;"><?php echo $rows['family_ID']; ?></td>
			<td><?php echo $rows['area_code']; ?></td>
			<td><?php echo $rows['family_name']; ?></td>
			<td><?php echo $rows['address']; ?></td>
			<td>
				<a href="edit_family.php?id=<?php echo $rows['family_ID'];?>">Edit</a> 
				<b>|</b>
				<a href="view_family.php?id=<?php echo $rows['family_ID'];?>">View</a> 

			</td>			
		</tr>
		<?php } ?>
		</table>     			
    </div>
	</div>
	<!-- THE BELOW FILE CONTAINS JAVA SCRIPT CODE TO FILTER AND SEARCH DATA THROUGHT THE TABLE, THIS A NECESSARY FILE FOR SEARCH PAGES -->
	<script src="../js/search_script.js"></script>


</body>
</html>