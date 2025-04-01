
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<link rel="stylesheet" type="text/css" href="../print.css">
	<script src="../print.js"></script>  
	<title></title>
</head>
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>EDIT FAMILY</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<div class="searchContainer">
		<form id="search_family" action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">
		<table width="80%" border="0">
			<tr>
				<td><b>UNIT</b></td>
				<td><b>Search</b></td>
			</tr>
			<tr>
				<td ><select name="area_code" onchange="search()">
					<option hidden>Area Code</option>
					<?php
		  				include "../connection.php";		  			
		            	$sql = "SELECT * FROM area_mapping 
		            	 ORDER BY area_code ASC";
		            	$result = $conn->query($sql);
		            	$conn->close();
						while ($rows=$result->fetch_assoc()) { 
							$area_Code = $rows['area_code'];
							$area_Name = $rows['area_name'];
						?>
					<option value="<?php echo $rows['area_code']; ?>"> <?php echo $rows['area_code'] .' - [' .  $rows['area_name'] . "]"; } ?> </option>
					</select>
				</td>	
				<td>
					<input type="text" id="searchbox" placeholder="Contact No. or Family head name" style="width: 600px;">
				</td>	
			</tr>
		</table>		
	</div>	

	<?php	
		$area_Code = "";
		$area_Code = @$_POST['area_code'];		
	?>
	<br>

	<div class="recordDisplayContainer" style="height: 75%;">
		<table border="1" class="recordDisplay" id="table" width="100%">
			<tr>
				<th width="5px"></th>
				<th width="10px">Area Code</th>
				<th width="4px">Family ID</th>			
				<th width="4px">Status</th>			
				<th width="50px">Head of the family</th>
				
				<th width="210px">Address</th>
				<th width="50px">ACTIONS</th>
			</tr>
			<?php
				include '../connection.php';
				$sql = "SELECT * FROM family_member WHERE area_code = '$area_Code' AND
				relation_with_head = 'Head' AND stationID = '$STATION_CODE'";
					$result = $conn->query($sql);									
					while ($rows=$result->fetch_assoc()){						 	
			?>			
			<tr>	
				<td></td>
				<td><?php echo $rows['area_code']; ?></td>
				<td><?php echo $rows['family_ID']; ?></td>
				<td><?php echo $rows['status']; ?></td>
				<td><?php echo $rows['name'] . " " . $rows['surname']; ?></td>
			
				<td><?php echo $rows['address']; ?></td>
				<td><a href="edit_family.php?id=<?php echo  $rows['family_ID'];?>">Edit</a></td>	
			</tr>
		<?php } ?>
		</table>		
	</div>
<br><br>
</div>

<script type="text/javascript">
	function search(){
		document.getElementById("search_family").submit();
	}
</script>

<script src="../js/search_script.js"></script>
</body>
</html>
