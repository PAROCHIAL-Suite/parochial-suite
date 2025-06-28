<?php
include "../connection.php";
$tenure = $_GET['tID'];
$sql = "SELECT * FROM council_master_table WHERE ID = '$tenure' 
   	AND  stationID = '$STATION_CODE' ";

$result = $conn->query($sql);
while ($rows = $result->fetch_assoc()) {
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
	<link rel="stylesheet" type="text/css" href="../print.css">
	<script src="../print.js"></script>
	<title></title>

</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName card-heading">
		<table border="0">
			<tr>
				<td width="40%">
					<h3>CREATE TERM</h3>
				</td>
			</tr>
		</table>
	</div>


	<form action="edit_term.php?id=<?php echo $tenure; ?>" method="post">
		<table class="form" cellspacing="10" border="0" width="30%">
			<tr>
				<td colspan="8">
					<h4>Create a new term</h4>
				</td>
			</tr>
			<tr>
				<td width="10%"><label>
						<p>START YEAR
					</label></td>
				<td width="50px">
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="start_dt"
						style="width: 100px" value="<?php echo $start_date; ?>">
				</td>
				<td width="10%"><label>
						<p>END YEAR
					</label></td>
				<td width="130px">
					<input type="number" pattern="\d{4}" maxlength="4" inputmode="numeric"
						oninput="this.value=this.value.slice(0,4)" placeholder="YYYY" name="end_dt" style="width: 100px"
						value="<?php echo $end_date; ?>">
				</td>
			</tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr>
				<td></td>
				<td width="10%"><input type="submit" name="update_tenure" value="Update"></td>
				<td><input class="btnDelete" type="submit" name="delete_tenure" value="Delete"> </td>
			</tr>
		</table>
	</form>
</body>

</html>