<?php
	include "../connection.php";

	$idR = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link rel="stylesheet" type="text/css" href="../css/baptism.css">
	<link rel="stylesheet" type="text/css" href="print.css">
	<title></title>
</head>
<body style="overflow: auto;">
	<?php include '../nav/global_nav.php';?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>EDIT FAMILY</h3></td>
			</tr>
		</table>
	</div>
	<br>

	<form id="" class="" method="post" action="edit_family_script.php?id=<?php echo $idR; ?>">
		<table width="100%"  border="0" cellspacing="10" class="form">		
			<tr>
				<td colspan="6" ><h4>Modify	Details</h4></td>
			</tr>	
			<?php 
			    $sql = "SELECT * FROM family_master_table 
			    		WHERE stationID = '$STATION_CODE' AND family_ID = '$idR'";    
			    $result = $conn->query($sql);
			    while ($rows=$result->fetch_assoc()){
			        $area_code = $rows['area_code']; 
			        $family_name = $rows['family_name'];
			        $address = $rows['address'];
			        $status = $rows['status'];
			    }
			?>			
			<tr>
				<td width="220px"><p>UNIT/AREA CODE</p></td>
				<td>
					<select name="area_code" onchange="search()">
					<option hidden><?php echo $area_code; ?></option>
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
				</tr>
			
			<tr>
				<td width=""><p>NAME OF THE FAMILY</p></td>
				<td width="200px"><input type="text" placeholder="Surname" value="<?php echo  $family_name;?>" id="family_name" name="family_name" required></td>	
				<td width="30px"><p>STATUS</p></td>
				<td>
					<select name="status">
						<option hidden><?php echo  $status; ?></option>
						<option>ACTIVE</option>
						<option>IN-ACTIVE</option>						
					</select>
				</td>
			</tr>
			<tr>	
				<td><p>ADDRESS</p></td>
				<td colspan="3"><input type="text" value="<?php echo $address; ?>"  name="address" id="address" style="width: 76.4%;"></td>						
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" name="update_family" value="UPDATE">  </td>
			</tr>
	</table>

	</div>


	<script src="../js/tab-page-script.js"></script>
	<script src="../js/search_script.js"></script>
</body>
</html>				


