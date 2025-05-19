<?php
include '../config/connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM eucharist WHERE reg_no = '$id' and stationID = '$STATION_CODE'";
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
		<title></title>
	</head>

	<body>
		<?php include '../nav/global_nav.php'; ?>
		<br><br>
		<div class="pageName card-heading">
			<table border="0">
				<tr>
					<td width="40%">
						<h3>EDIT HOLY COMMUNION RECORD</h3>
					</td>
				</tr>
			</table>

		</div>
		<br>

		<form id="baptism_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<table width="100%" border="0" cellspacing="10" class="form">
				<tr>
					<td colspan="4">
						<h4>Certificate Details</h4>
					</td>
				</tr>
				<tr></tr>
				<tr>
					<td>
						<p>REGISTRATION NO.</p>
					</td>
					<td><input type="text" name="reg_no" value="<?php echo $rows['reg_no']; ?>" readonly></td>
				</tr>
				<tr>
					<td>
						<p>NAME</p>
					</td>
					<td><input type="text" name="name" value="<?php echo $rows['name']; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>SURNAME</p>
					</td>
					<td><input type="text" name="surname" value="<?php echo $rows['surname']; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>BAPTISM DATE</p>
					</td>
					<td><input type="date" name="baptism_date" value="<?php echo $rows['baptism_date']; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>BAPTISM REGISTRATION NO.</p>
					</td>
					<td><input type="text" name="baptism_reg" value="<?php echo $rows['baptism_reg_no']; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>BAPTISM PARISH NAME</p>
					</td>
					<td><input type="text" name="baptism_parish" value="<?php echo $rows['baptism_parish']; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>PARISH ADDRESS</p>
					</td>
					<td><input type="text" name="p_address" value="<?php echo $rows['parish_address']; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>CHURCH OF HOLY COMMUNION</p>
					</td>
					<td><input type="text" name="church_of_eucharist" value="<?php echo $rows['church_of_comunion']; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<p>DATE OF HOLY COMMUNION</p>
					</td>
					<td><input type="date" name="date" value="<?php echo $rows['date_of_communion']; ?>"></td>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<td colspan="4">
						<h4>Parochial Details</h4>
					</td>
				</tr>
				<tr></tr>
				<tr>
					<td>
						<p>MINISTER'S NAME</p>
					</td>
					<td><input type="text" name="minister_name" value="<?php echo $rows['minister']; ?>"></td>
				</tr>
				<tr>
					<td>
						<p>PARISH PRIEST</p>
					</td>
					<td><input type="text" name="parish_priest" value="<?php echo $rows['parish_priest'];
} ?>"></td>
			</tr>

			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr>
				<td></td>
				<td>
					<button>Cancel</button>
					<input type="submit" name="edit_eucharist_from" id="saveFrm" value="Save">
				</td>
				<td></td>
			</tr>
		</table>
	</form><br><br>
</body>

</html>


<?php

$year = date("Y");

if (isset($_POST['edit_eucharist_from'])) {
	include '../config/connection.php';
	$rID = $_POST['reg_no'];
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$baptism_reg = mysqli_real_escape_string($conn, $_POST['baptism_reg']);
	$baptism_date = mysqli_real_escape_string($conn, $_POST['baptism_date']);
	$baptism_parish = mysqli_real_escape_string($conn, $_POST['baptism_parish']);
	$address = mysqli_real_escape_string($conn, $_POST['p_address']);
	$church_of_eucharist = mysqli_real_escape_string($conn, $_POST['church_of_eucharist']);
	$minister_name = mysqli_real_escape_string($conn, $_POST['minister_name']);
	$parish_priest = mysqli_real_escape_string($conn, $_POST['parish_priest']);
	$date = $_POST['date'];

	$todayDate = date("d-M-Y");
	$sql = "UPDATE eucharist SET
		name = '$name',
		surname = '$surname',
		baptism_reg_no = '$baptism_reg',
		baptism_date = '$baptism_date',
		baptism_parish = '$baptism_parish' ,
		parish_address = '$address ',
		church_of_comunion = '$church_of_eucharist' ,
		minister = '$minister_name',
		parish_priest = '$parish_priest',
		updated_on = '$todayDate', author = '$USERNAME'	WHERE reg_no = '$rID' and stationID = '$STATION_CODE'";
	if (mysqli_query($conn, $sql)) {
		echo "
			<script>
				 alert('Register of confirmation has been updated')		    	
			</script>";
		header("Location: ../eucharist/search_communion.php");

	} else {
		echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}
}


?>