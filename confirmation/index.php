<?php
include '../config/connection.php';
$sql = "SELECT COUNT(*) as total FROM confirmation";
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
	<div class="pageName">
		<a href="sacrament_search_index.php" class="" style="float: right; margin-right: 50px; ">
			<i class="fas fa-search"></i> Search - Communion Reports
		</a>
		<h3>REGISTRATION OF HOLY COMMUNION</h3>
	</div>
	<div class="form-header">
		<div class="form-actions">
			<button type="submit" class="btn-primary" onclick="document.getElementById('post_eucharist_from').click()">
				<i class="fas fa-save"></i> Save
			</button>
			<button class="btn-secondary" onclick="location.reload()">
				<i class="fas fa-times"></i> Reset
			</button>
		</div>
		<div class="form-actions">
			<div class="">
				<label><b>Recent Transaction</b></label>
				<h4 style="color: var(--accent-color);"><span style="font-weight: normal; ">Reg. No.</span>
					<?php echo $lastCreated; ?></h4>
			</div>
		</div>
	</div>

	<form id="eucharistFormReg" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Registration Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="">NAME</label>
					<input type="text" name="name" required>
				</div>
				<div class="form-group">
					<label for="surname">SURNAME</label>
					<input type="text" name="surname">
				</div>
				<div class="form-group">
					<label for="dob">DATE OF BIRTH</label>
					<input type="text" class="auto-format-date" name="dob" placeholder="dd/mm/yyyy">
				</div>

			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">GENDER</label>
					<select name="gender">
						<option value="" hidden required>Select</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				<div class="form-group">
					<label for="father_name">FATHER'S NAME</label>
					<input type="text" name="father_name">
				</div>

				<div class="form-group">
					<label for="mother_name">MOTHER'S NAME</label>
					<input type="text" name="mother_name">
				</div>
			</div>

			<div class="form-section-header">
				<h3>Parochial Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="baptism_reg">BAPTISM REGISTRATION NO.</label>
					<input type="text" name="baptism_reg" required>
				</div>

				<div class="form-group">
					<label for="baptism_date">BAPTISM DATE</label>
					<input type="text" class="auto-format-date" name="baptism_date" placeholder="dd/mm/yyyy">
				</div>

				<div class="form-group">
					<label for="baptism_parish">BAPTISM PARISH NAME</label>
					<input type="text" name="baptism_parish">
				</div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="p_address">PARISH ADDRESS</label>
					<input type="text" name="p_address">
				</div>

				<div class="form-group">
					<label for="church_of_eucharist">CHURCH OF CONFIRMATION</label>
					<input type="text" name="church_of_confirmaiton">
				</div>

				<div class="form-group">
					<label for="date">DATE OF CONFIRMATION<label>
							<input type="text" class="auto-format-date" name="date_of_confirmation"
								placeholder="dd/mm/yyyy">
				</div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="sponsor">SPONSOR</label>
					<input type="text" name="sponsor">
				</div>
				<div class="form-group">
					<label for="minister_name">MINISTER'S NAME</label>
					<input type="text" name="minister_name">
				</div>

				<div class="form-group">
					<label for="parish_priest">PARISH PRIEST</label>
					<input type="text" name="parish_priest">
				</div>


			</div>

		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="post_eucharist_from" id="post_eucharist_from">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
	</form>

</body>

</html>


<?php

$year = date("Y");


if (isset($_POST['post_eucharist_from'])) {
	include '../config/connection.php';
	$reg_no = $total_records . "/" . $year;
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
	$mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);

	$baptism_reg = mysqli_real_escape_string($conn, $_POST['baptism_reg']);
	$baptism_date = mysqli_real_escape_string($conn, $_POST['baptism_date']);

	$baptism_parish = mysqli_real_escape_string($conn, $_POST['baptism_parish']);
	$address = mysqli_real_escape_string($conn, $_POST['p_address']);
	$church_of_confirmation = mysqli_real_escape_string($conn, $_POST['church_of_confirmation']);
	$sponsor = mysqli_real_escape_string($conn, $_POST['sponsor']);
	$minister_name = mysqli_real_escape_string($conn, $_POST['minister_name']);
	$parish_priest = mysqli_real_escape_string($conn, $_POST['parish_priest']);
	$date = $_POST['date'];

	$sql = "INSERT INTO confirmation VALUES(
			'',
			'$STATION_CODE',
			'$reg_no',
			'$name',
			'$surname',
			'$dob', '$gender', '$father_name', '$mother_name',
			'$baptism_reg',
			'$baptism_date',
			'$baptism_parish' ,
			'$address',
			'$church_of_confirmation',
			'$sponsor',
			'$minister_name',
			'$parish_priest',
			'$date', '', ''	)";
	if (mysqli_query($conn, $sql)) {
		echo "
				<script>
				    alert('A new Confirmation record has been created.');			    	
				</script>";
		$total_records = $total_records + 1;
	} else {
		echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
	}
}


?>