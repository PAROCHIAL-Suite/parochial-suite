<?php
include '../config/connection.php';
// Get the current user's username from the session
$sql = "SELECT * FROM parish_info WHERE stationID = '$STATION_CODE'";
$result = $conn->query($sql);
$parishName = '';
if ($result && $result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$parishName = $row['p_name'];
}

// Get the last created date from the baptism table
$sql = "SELECT reg_no FROM baptism WHERE stationID = '$STATION_CODE' ORDER BY created_on DESC LIMIT 1";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$lastCreated = $row['reg_no'];
} else {
	$lastCreated = "No records found";
}

$form_error_message = '';
// Code to handle form submission
if (isset($_POST['post_bpt_frm'])) {
	$reg_no = mysqli_real_escape_string($conn, $_REQUEST['reg_no']);
	// Check for duplicate reg_no for this station
	$dup_sql = "SELECT COUNT(*) as cnt FROM baptism WHERE reg_no = '$reg_no' AND stationID = '$STATION_CODE'";
	$dup_result = $conn->query($dup_sql);
	$dup_row = $dup_result ? $dup_result->fetch_assoc() : ['cnt' => 0];

	if ($dup_row['cnt'] > 0) {
		$form_error_message = "A burial record with this Registration Number already exists for this station.";
	} else {
		$baptism_date = $_REQUEST['baptism_dt'];
		$dob = $_REQUEST['dob'];
		$gender = $_REQUEST['gender'];
		$name = $_REQUEST['name'];
		$surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);
		$father_name = mysqli_real_escape_string($conn, $_REQUEST['father_name']);
		$mother_name = mysqli_real_escape_string($conn, $_REQUEST['mother_name']);
		$father_nationality = $_REQUEST['nationality'];
		$address = mysqli_real_escape_string($conn, $_REQUEST['address']);
		$father_occupation = $_REQUEST['occupation'];
		$godfather_name = mysqli_real_escape_string($conn, $_REQUEST['godfather_name']);
		$godfather_address = mysqli_real_escape_string($conn, $_REQUEST['godfather_address']);
		$godmother_name = mysqli_real_escape_string($conn, $_REQUEST['godmother_name']);
		$godmother_address = mysqli_real_escape_string($conn, $_REQUEST['godmother_address']);
		$church_name = mysqli_real_escape_string($conn, $_REQUEST['place_of_baptism']);
		$minister_name = mysqli_real_escape_string($conn, $_REQUEST['minister_name']);
		$communion = mysqli_real_escape_string($conn, $_REQUEST['communion']);
		$confirmation = mysqli_real_escape_string($conn, $_REQUEST['confirmation']);
		$marriage = mysqli_real_escape_string($conn, $_REQUEST['marriage']);
		$remarks = mysqli_real_escape_string($conn, $_REQUEST['remarks']);

		$created_on = date("d-m-Y H:i:s");

		$sql = "INSERT INTO baptism VALUES(			
			'$reg_no',
			'$STATION_CODE',
			'$baptism_date',
			'$dob',
			'$gender',
			'$name',
			'$surname',
			'$father_name',
			'$mother_name',
			'$father_nationality',	
			'$address',		
			'$father_occupation', 		
			'$godfather_name', 
			'$godfather_address',
			'$godmother_name', 
			'$godmother_address', 
			'$church_name', 
			'$minister_name',
			'$communion', 
			'$confirmation',
			'$marriage', 
			'$remarks',
			'','$created_on', '$USERNAME')";
		if ($conn->query($sql)) {
			echo "
				<script>
					alert('A new baptism record has been created.');
					window.location.href = 'baptism_reg.php';
				</script>";
			exit;
		} else {
			$form_error_message = "ERROR: Hush! Sorry $sql. " . $conn->error;
		}
	}



}



?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochailUI.css">
	<title></title>
</head>

<body>
	<!-- Include the global navigation bar -->
	<?php include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<!-- <a href="sacrament_search_index.php" class="" style="float: right; margin-right: 50px; ">
			<i class="fas fa-search"></i> Search - Baptism Reports
		</a> -->
		<h3>REGISTRATION OF BAPTISM</h3>
	</div>
	<br>

	<!-- Error dialog include -->
	<?php include '../dialog/form_error_dialog.php'; ?>


	<div class="form-header">
		<div class="form-actions">
			<button type="submit" class="btn-primary" onclick="document.getElementById('post_bpt_frm').click()">
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

	<!-- Form for baptism registration -->
	<form id="baptismFrom" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Registration Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Pries Name">REGISTRATION NUMBER</label>
					<input type="text" name="reg_no" placeholder="Number" required>
				</div>
				<div class="form-group">
					<label for="Pries Name">DATE OF BAPTISM</label>
					<input type="text" name="baptism_dt" class="auto-format-date" placeholder="dd/mm/yyyy">
				</div>
				<div class="form-group">
					<!-- <label for="Pries Name">YEAR OF REGISTRATION</label>
					<input type="text" name="reg_year" placeholder="Year" required> -->
				</div>
			</div>

			<div class="form-section-header">
				<h3>Basic Information</h3>
			</div>
			<!-- NEW ROWS -->
			<div class="form-grid">
				<div class="form-group">
					<label for="Name">NAME</label>
					<input type="text" name="name">
				</div>
				<div class="form-group">
					<label for="Name">SURNAME</label>
					<input type="text" name="surname">
				</div>
				<div class="form-group">
					<label for="Name">DATE OF BIRTH</label>
					<input type="text" name="dob" class="auto-format-date" placeholder="dd/mm/yyyy">
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
					<label for="Name">FATHER'S NAME</label>
					<input type="text" name="father_name">
				</div>
				<div class="form-group">
					<label for="Name">MOTHER'S NAME</label>
					<input type="text" name="mother_name">
				</div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">NATIONALITY</label>
					<input type="text" name="nationality">
				</div>
				<div class="form-group">
					<label for="Name">ADDRESS</label>
					<textarea id="address" rows="3" name="address"></textarea>
				</div>
				<div class="form-group">
					<label for="Name">FATHER'S OCCUPATION</label>
					<input type="text" name="occupation">
				</div>
			</div>

			<div class="form-section-header">
				<h3>Godparents Information</h3>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">GODFATHER'S NAME</label>
					<input type="text" name="godfather_name">
				</div>
				<div class="form-group">
					<label for="Name">HIS ADDRESS</label>
					<textarea id="address" rows="3" name="godfather_address"></textarea>
				</div>
				<div class="form-group"></div>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Name">GODMOTHER'S NAME</label>
					<input type="text" name="godmother_name">
				</div>
				<div class="form-group">
					<label for="Name">HER ADDRESS</label>
					<textarea id="address" rows="3" name="godmother_address"></textarea>
				</div>
				<div class="form-group"></div>
			</div>
			<div class="form-section-header">
				<h3>Godparents Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="Name">PLACE OF BAPTISM</label>
					<input type="text" name="place_of_baptism" value="<?php echo $parishName; ?>">
				</div>

				<div class="form-group">
					<label for="Name">MINISTER'S NAME</label>
					<input type="text" name="minister_name">
				</div>
				<div class="form-group"></div>
			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">COMMUNION</label>
					<textarea id="communion" rows="3" name="communion"></textarea>
				</div>
				<div class="form-group">
					<label for="Name">CONFIRMATION</label>
					<textarea id="place_of_baptism" rows="3" name="confirmation"></textarea>
				</div>

				<div class="form-group">
					<label for="Name">MARRIAGE</label>
					<textarea id="marriage" rows="3" name="marriage"></textarea>
				</div>

			</div>

			<div class="form-grid">
				<div class="form-group">
					<label for="Name">REMARKS</label>
					<textarea id="address" rows="3" name="remarks"></textarea>
				</div>
				<div class="form-group"></div>
				<div class="form-group"></div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="post_bpt_frm" id="post_bpt_frm">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload()">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
	</form>
	<br><br><br>
</body>

</html>