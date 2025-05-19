<?php
include '../config/connection.php';
$sql = "SELECT COUNT(*) as total FROM eucharist";
$result = $conn->query($sql);

if ($result) {
	// Fetch the result as an associative array
	$row = $result->fetch_assoc();
	$total_records = $row['total'];
	if ($total_records == 0) {
		// code...
		$total_records = 1;
	} elseif ($total_records > 0) {
		// code...

		// code...
		$total_records = $total_records + 1;
	}

} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}


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
					<h3>REGISTRATION OF HOLY COMMUNION</h3>
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
					<p>NAME</p>
				</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>
					<p>SURNAME</p>
				</td>
				<td><input type="text" name="surname"></td>
			</tr>
			<tr>
				<td>
					<p>BAPTISM DATE</p>
				</td>
				<td><input type="date" name="baptism_date"></td>
			</tr>
			<tr>
				<td>
					<p>BAPTISM REGISTRATION NO.</p>
				</td>
				<td><input type="text" name="baptism_reg"></td>
			</tr>
			<tr>
				<td>
					<p>BAPTISM PARISH NAME</p>
				</td>
				<td><input type="text" name="baptism_parish"></td>
			</tr>
			<tr>
				<td>
					<p>PARISH ADDRESS</p>
				</td>
				<td><input type="text" name="p_address"></td>
			</tr>
			<tr>
				<td>
					<p>CHURCH OF HOLY COMMUNION</p>
				</td>
				<td><input type="text" name="church_of_eucharist"></td>
			</tr>
			<tr>
				<td>
					<p>DATE OF HOLY COMMUNION</p>
				</td>
				<td><input type="date" name="date"></td>
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
				<td><input type="text" name="minister_name"></td>
			</tr>
			<tr>
				<td>
					<p>PARISH PRIEST</p>
				</td>
				<td><input type="text" name="parish_priest"></td>
			</tr>

			<tr></tr>
			<tr></tr>
			<tr></tr>
			<tr>
				<td></td>
				<td>
					<button>Cancel</button>
					<input type="submit" name="post_eucharist_from" id="saveFrm">
				</td>
				<td></td>
			</tr>
		</table>
	</form><br><br>
</body>

</html>


<?php

$year = date("Y");

if (isset($_POST['post_eucharist_from'])) {
	include '../config/connection.php';
	$reg_no = $total_records . "/" . $year;
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

	$sql = "INSERT INTO eucharist VALUES(
		'',
		'$STATION_CODE',
		'$reg_no',
		'$name',
		'$surname',
		'$baptism_reg',
		'$baptism_date',
		'$baptism_parish' ,
		'$address ',
		'$church_of_eucharist' ,
		'$minister_name',
		'$parish_priest',
		'$date', '', ''	)";
	if (mysqli_query($conn, $sql)) {
		echo "
			<script>
			    alert('A new Holy Communion record has been created.');			    	
			</script>";
		$total_records = $total_records + 1;
	} else {
		echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}
}


?>