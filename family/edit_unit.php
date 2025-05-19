<?php
include '../config/connection.php';

$uID = $_GET['unitID'];


if (isset($_POST['update_unit_code'])) {
	// code...
	$area_name = $_POST['area_name'];
	$given_name = $_POST['given_name'];
	$area_code = $_POST['area_code'];

	$sql = "UPDATE area_mapping SET area_name = '$area_name', area_code = '$area_code', given_name = '$given_name' WHERE ID = '$uID'";

	if (mysqli_query($conn, $sql)) {
		header("Location: create_unit.php");
	} else {
		echo "ERROR: $sql. " . mysqli_error($conn);
	}
}


if (isset($_POST['delete_unit_code'])) {
	// code...

	$sql = "DELETE FROM area_mapping WHERE ID = '$uID'";

	if (mysqli_query($conn, $sql)) {
		header("Location: create_unit.php");
	} else {
		echo "ERROR: $sql. " . mysqli_error($conn);
	}
}

$sql = "SELECT * FROM area_mapping WHERE ID = '$uID' ";
$result = $conn->query($sql);
while ($rows = $result->fetch_assoc()) {


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
					<td width="40%">
						<h3>CREATE UNIT</h3>
					</td>
				</tr>
			</table>
		</div>
		<br>

		<form id="" class="" method="post" action="">
			<table width="20%" border="0" cellspacing="14" class="form" style="">
				<tr>
					<td colspan="8">
						<h4>Area/Unit Mapping</h4>
					</td>
				</tr>
				<tr>
					<td>
						<p>AREA NAME</p>
					</td>
					<td>
						<p>GIVEN NAME</p>
					</td>
					<td>
						<p>SET A CODE NAME</p>
					</td>
				</tr>
				<tr>

					<td><input type="text" name="area_name" value="<?php echo $rows['area_name']; ?>"></td>

					<td><input type="text" name="given_name" value="<?php echo $rows['given_name']; ?>"> </td>
					<td><input type="text" name="area_code" value="<?php echo $rows['area_code'];
} ?>"> </td>

			</tr>
			<tr></tr>
			<tr></tr>
			<tr>
				<td><input type="submit" name="update_unit_code" value="Update">
				</td>
			</tr>
			<tr></tr>
			<tr></tr>
			<td>
				<input type="submit" name="delete_unit_code" value="Delete">
			</td>
			</tr>

		</table>
	</form>
</body>

</html>