
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
				<td width="40%"><h3>ADD A MEMBER</h3></td>
			</tr>
		</table>
	</div>
	<br>
	<div class="searchContainer">
		<form id="search_family" action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">
		<table width="50%" border="0" cellspacing="10">

			<tr>
				<td width="8%"><b>SELLECT TENURE</b></td>
				<td ><select name="area_code" onchange="">
					<option hidden>Select Tenure</option>
					<?php
		  				include "../connection.php";		  			
		            	$sql = "SELECT * FROM council_master_table ORDER BY start_date DESC
		            	 ";
		            	$result = $conn->query($sql);
		            	$conn->close();
						while ($rows=$result->fetch_assoc()){ 
							$start_date = $rows['start_date'];
							$end_date = $rows['end_date'];
						?>
					<option selected value="<?php echo $rows['ID']?>"> <?php echo $rows['start_date'] .' - '. $rows['end_date']; } ?> </option>
					</select>
					<button onclick="search()">Get List</button>
				</td>		
			</tr>
		</table>	
	<?php	
		$area_Code = "";
		$area_Code = @$_POST['area_code'];		
	?>			
	</div>	
	<br>

	<div class="recordDisplayContainer" style="height: 65%;" >
		<table border="1" class="recordDisplay" id="table" width="100%">
			<tr>
				<th width="4%">ID</th>			
				<th width="14%">Comittees Names</th>			
				<th width="15%">ACTIONS</th>
			</tr>
			<?php
				include '../connection.php';

				$sql = "SELECT 
				council_master_table.start_date,
				council_master_table.end_date,
				council_group.group_name, 
				council_group.termID , council_group.ID as cgID

				FROM council_master_table 

				LEFT JOIN council_group 
				ON council_master_table.ID = council_group.termID				

					WHERE council_group.termID = '$area_Code' 
						AND council_group.stationID = '$STATION_CODE'";
					$result = $conn->query($sql);									
					while ($rows=$result->fetch_assoc()){						 	
			?>			
			<tr>	
			
				<td><?php echo $rows['cgID']; ?></td>	
				<td><?php echo $rows['group_name']; ?></td>	

				<td><a href="add_member.php?id=<?php echo $rows['cgID'];?>">Add member</a></td>	
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
