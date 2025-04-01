<?php
	include '../connection.php';
	$priest_id = $_GET['id'];

	$sql = "SELECT * FROM priest WHERE ID = '$priest_id' AND stationID = '$STATION_CODE'";
	$result = $conn->query($sql);
			
	while ($rows=$result->fetch_assoc()){
		$name = $rows['name'];
		$designation = $rows['designation'];
		$start_date = $rows['start_date'];
		$end_date = $rows['end_date'];
	}	
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
<body>
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%"><h3>PRIEST</h3></td>
			</tr>
		</table>
	</div>
	<br>

	<form id="" class="" method="post" action="update_priest.php?id=<?php echo $priest_id;?>">
		<table border="0" cellspacing="10" class="form">
			<tr>
				<td colspan="10"><h4>Priest Details</h4></td>
			</tr>
			<tr>
				<td width="10%"><p>PRIEST NAME</p></td>
				<td width="10%"><input type="text" name="name" value="<?php echo $name; ?>">  </td>

				<td width="10%"><p>DESIGNATION</p></td>
				<td>
					<select name="designation">
						<option hidden><?php echo $designation; ?></option>
						<option>Parish Priest</option>
						<option>Asst. Parish Priest</option>
						<option>Parish Priest (In-Charge)</option>
					</select>
				</td>	
			</tr>
			<tr>
				<td><p>START DATE</p></td>
				<td>
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric" oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="start_date" value="<?php echo $start_date; ?>">  
				</td>
				<td><p>END DATE</p></td>
				<td width="140px">
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric" oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="end_date" value="<?php echo $end_date; ?>">
				</td>										
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="update_priest" value="Update">  </td>
			</tr>
		</table>
	</form>

</body>
</html>

<?php 

?>