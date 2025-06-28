<?php

include '../config/connection.php';
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['add_anointing'])) {
	$patient_name = mysqli_real_escape_string($conn, $_REQUEST['patient_name']);
	$age = mysqli_real_escape_string($conn, $_REQUEST['age']);
	$gender = mysqli_real_escape_string($conn, $_REQUEST['gender']);
	$contact_no = mysqli_real_escape_string($conn, $_REQUEST['contact_no']);
	$address = mysqli_real_escape_string($conn, $_REQUEST['address']);
	$date = mysqli_real_escape_string($conn, $_REQUEST['date']);
	$priest_name = mysqli_real_escape_string($conn, $_REQUEST['priest_name']);
	$remarks = mysqli_real_escape_string($conn, $_REQUEST['remarks']);

	$sql = "INSERT INTO anointing_of_the_sick (stationID, patient_name, age, gender, contact_no, address, date, priest_name, remarks) 
            VALUES ('$STATION_CODE', '$patient_name', '$age', '$gender', '$contact_no', '$address', '$date', '$priest_name', '$remarks')";
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Anointing record added successfully!');</script>";
	} else {
		echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/parochialUI.css">
	<link rel="stylesheet" type="text/css" href="print.css">
	<title>Anointing of the Sick</title>
</head>

<body>
	<?php @include '../nav/app_header_nav.php';
	include '../nav/global_nav.php'; ?>
	<br><br>
	<div class="pageName">
		<h3>ANOINTING OF THE SICK</h3>
	</div>
	<br>
	<!-- form to add new anointing record -->
	<form id="addAnointingForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
		enctype="multipart/form-data">
		<div class="form-section">
			<div class="form-section-header">
				<h3>Patient Information</h3>
			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="patient_name">Patient Name</label>
					<input type="text" id="patient_name" name="patient_name" required>
				</div>
				<div class="form-group">
					<label for="age">Age</label>
					<input type="number" id="age" name="age" min="0" max="130" required
						oninput="if(this.value < 0) this.value=0; if(this.value > 100) this.value=100;">
				</div>
				<div class="form-group">
					<label for="gender">Gender</label>
					<select id="gender" name="gender" required>
						<option value="" hidden>Select</option>
						<option>Male</option>
						<option>Female</option>
						<option>Other</option>
					</select>
				</div>

			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="contact_no">Contact No.</label>
					<input type="text" id="contact_no" name="contact_no" class="auto-format-contact" required>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<textarea id="address" name="address" rows="2" required></textarea>
				</div>
				<div class="form-group">
					<label for="date">Date of Anointing</label>
					<input type="text" id="date" name="date" class="auto-format-date" required>
				</div>

			</div>
			<div class="form-grid">
				<div class="form-group">
					<label for="priest_name">Priest Name</label>
					<input type="text" id="priest_name" name="priest_name" required>
				</div>
				<div class="form-group">
					<label for="remarks">Remarks</label>
					<textarea id="remarks" name="remarks" rows="2"></textarea>
				</div>
				<div></div>
			</div>
		</div>
		<div class="form-header">
			<div class="form-actions">
				<button type="submit" class="btn-primary" name="add_anointing">
					<i class="fas fa-save"></i> Save
				</button>
				<button class="btn-secondary" onclick="location.reload(); return false;">
					<i class="fas fa-times"></i> Reset
				</button>
			</div>
		</div>
		<br><br>
	</form>
</body>

</html>